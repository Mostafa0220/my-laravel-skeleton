<?php

namespace App\Http\Controllers\Admin\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\RoleRequest;

use App\Models\Role;

use Gate;
use DataTables;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('index-role-admin')) {
            return abort(403);
        }

        if (request()->ajax()) {
            return $this->datatables();
        }

        return view('admin.roles.index');
    }

    protected function datatables()
    {
        $role = Role::all();

        return DataTables::of($role)
            ->addColumn('action', function ($role) {
                return view('admin.components.action-buttons', [
                    'edit_url' => route('admin.roles.edit', $role->id),
                    'delete_url' => route('admin.roles.destroy', $role->id),
                    'show_url' => route('admin.roles.show', $role->id)
                ]);
            })
            ->addColumn('created_at', function ($role) {
                return $role->created_at->format('d F Y \a\t h:i A');
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('create-role-admin')) {
            return abort(403);
        }

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $request->merge([
                'slug' => str_slug($request->name),
                'permissions' => [],
                'state' => 'active'
            ]);

            $role = Role::create($request->all());

            flash('Role ' . $role->slug . ' successfully created', 'success');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            (config('app.env') == 'local') ? flash('Failed ' . $e->getMessage(), 'danger') : flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('show-role-admin')) {
            return abort(403);
        }

        $role = Role::findOrFail($id);

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('edit-role-admin')) {
            return abort(403);
        }

        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $request->merge([
                'slug' => str_slug($request->name),
                'permissions' => [],
                'state' => 'active'
            ]);
            $role = Role::findOrFail($id);
            $role->update($request->all());

            flash('Role ' . $role->email . ' successfully updated', 'success');

            return redirect()->back();
        } catch (\Exception $e) {
            (config('app.env') == 'local') ? flash('Failed ' . $e->getMessage(), 'danger') : flash('Failed! ', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
