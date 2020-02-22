<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AppSetting;
use Storage;

class AppSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (!$request->session()->has('appSettings')) {
            $configs = AppSetting::all();
            $settings=[];
            
            foreach ($configs as $config){
                $key=$config->field_name;
                $value=$config->value;
                $settings[$key] = $value;
            }
            
            $request->session()->put("appSettings", (object) $settings);
        }
        
        return $next($request);
        //return abort(403);
    }
}
