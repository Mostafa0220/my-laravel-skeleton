<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Role;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

use DataTables;
use Gate;
use Auth;
use Storage;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(!Gate::allows('index-user-admin')) {
            return abort(403);
        }

        if (request()->ajax()) {
            return $this->datatables();
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create-user-admin')) {
            return abort(403);
        }

        $roles = Role::whereState('active')->pluck('name', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'avatar' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $request->merge([ 'password' => bcrypt($request->password) ]);
            if($request->hasFile('avatar')){

                $avatarName = 'avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('avatars',$avatarName);

                $request->merge([ 'avatar' => $avatarName ]);


            }

            $user = User::create($request->all());

            $user->roles()->attach($request->role_id);

            flash('Account '. $user->email.' successfully created', 'success');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            (config('app.env')=='local')?flash('Failed '. $e->getMessage(), 'danger'):flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Gate::allows('show-user-admin')) {
            return abort(403);
        }

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }
    public function profile()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('edit-user-admin')) {
            return abort(403);
        }

        $user = User::findOrFail($id);
        $roles = Role::whereState('active')->pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function editProfile()
    {
        $id=Auth::user()->id;

        $user = User::findOrFail($id);
        $roles = Role::whereState('active')->pluck('name', 'id');
        $title='Edit Profile';
        return view('admin.users.edit', compact('user', 'roles','title'));
    }
    public function changePassword()
    {
        return view('admin.users.change-password');
    }
    public function storePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);


        try {
           // User::find(auth()->user()->id)->update(['password'=> bcrypt($request->new_password)]);
           User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            flash('Password change successfully!', 'success');

            return redirect()->back();
        } catch (\Exception $e) {
            (config('app.env')=='local')?flash('Failed '. $e->getMessage(), 'danger'):flash('Failed! ', 'danger');
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
                'name' => 'required|min:4|max:25',
                'email' => 'required|email|unique:users,email,'.$user->id
            ]);
        try {

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $request->validate([

                    'password' => 'min:6',

                ]);
                $user->password = bcrypt($request->password);
            }
            if($request->hasFile('avatar')){



                $this->validate($request,[

                    'avatar' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('avatars',$avatarName);
                $old_avatar=storage_path('app/avatars/'.$user->avatar);
                // unlink($old_avatar);
                if(is_file($old_avatar))
                    Storage::delete('avatars/'.$user->avatar);

                $user->avatar = $avatarName;

            }
            $user->save();
            $user->roles()->attach($request->role_id);

            flash('Account '. $user->email.' successfully updated', 'success');

            return redirect()->back();
        } catch (\Exception $e) {
            (config('app.env')=='local')?flash('Failed '. $e->getMessage(), 'danger'):flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('destroy-user-admin')) {
            return abort(403);
        }
        $user = User::findOrFail($id);


        try {
            $user->delete();

            flash('Account '. $user->email.' successfully deleted', 'success');

            return redirect()->back();
        } catch (\Exception $e) {
            (config('app.env')=='local')?flash('Failed '. $e->getMessage(), 'danger'):flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export($type='csv')
    {
        if (! in_array($type, ['xlsx','xls', 'csv'])) {
            $type = 'csv';
        }
        $fn = 'users'.'-'.date('Y-m-d_H-i-s');
        return Excel::download(new UsersExport, $fn.'.'.$type);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        $import = new UsersImport;
        try {
            Excel::import($import, request()->file('file'));
            $row_count=$import->getRowCount();

            flash($row_count.' Users successfully imported!', 'success');

            return redirect()->back();
        }catch (\Exception $e) {
            (config('app.env')=='local')?flash('Failed '. $e->getMessage(), 'danger'):flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }
    protected function datatables()
    {
        $user = User::all();
        return DataTables::of($user)
            ->addColumn('action', function ($user){
                return view('admin.components.action-buttons', [
                    'edit_url'       => route('admin.users.edit', $user->id),
                    'delete_url'     => route('admin.users.destroy', $user->id),
                    'show_url'     => route('admin.users.show', $user->id)
                ]);
            })
            ->addColumn('created_at', function ($user){
                return $user->created_at->format('d F Y \a\t h:i A');
            })
            ->escapeColumns([])
            ->make(true);
    }
}
