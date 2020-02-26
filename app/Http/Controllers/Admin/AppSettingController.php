<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Session;
use Gate;
use Storage;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* if(!Gate::allows('edit-user-admin')) {
            return abort(403);
        } */

        $configs = AppSetting::all();
        if ($configs) {
            foreach ($configs as $c) {
                $key = $c->field_name;
                $arr[$key] = $c->value;
            }
            $configs = $arr;
        }

        return view('admin.settings.edit', compact('configs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $configs = AppSetting::all();
        if ($configs) {
            if ($request->input()) {
                foreach ($request->input() as $key => $value) {
                    if ($key) {
                        if ($key != "_token") {
                            $row = AppSetting::whereFieldName($key)->first();

                            if ($row) {
                                $row->value = $value;
                                $row->save();
                            } else {
                                AppSetting::create(['field_name' => $key, 'value' => $value]);
                            }
                        }
                    }
                }

                $img_to_upload = ['logo', 'favicon'];
                for ($i = 0; $i < count($img_to_upload); $i++) {
                    $key = $img_to_upload[$i];
                    if ($request->hasFile($key)) {


                        $this->validate($request, [

                            $key => 'mimes:ico,jpeg,png,jpg,gif,svg|max:2048',

                        ]);

                        //upload logo to storage folder
                        $fileName = $key . time() . '.' . request()->$key->getClientOriginalExtension();
                        $request->$key->storeAs($key, $fileName);
                        $value = $fileName;
                        $row = AppSetting::whereFieldName($key)->first();
                        if ($row) {

                            $old_file = storage_path('app/' . $key . '/' . $row->value);

                            //delete old logo if file exists
                            if ($row->value && is_file($old_file))
                                Storage::delete($key . '/' . $row->value);

                            $row->value = $value;
                            $row->save();
                        } else {
                            AppSetting::create(['field_name' => $key, 'value' => $value]);
                        }

                    }
                }
                $configs = AppSetting::get();

                if ($configs) {

                    foreach ($configs as $c) {
                        $key = $c->field_name;
                        $settings[$key] = $c->value;

                    }
                    Session::put("appSettings", (object)$settings);

                }
                flash('Configurations successfully updated', 'success');
                return redirect()->back();
            }


        }
    }
}
