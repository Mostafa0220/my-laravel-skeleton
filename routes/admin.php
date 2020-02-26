<?php

Route::group([ 'as' => 'admin.' ], function () {

    Route::get('login', 'AuthController@login')->name('login');
    Route::post('login/store', 'AuthController@store')->name('login.store');

    Route::group([ 'middleware' => 'auth' ], function (){

        Route::get('/', 'DashboardController@index')->name('dashboard.index');
        Route::get('/logout', 'AuthController@logout');
        Route::resources([
            'settings' => 'AppSettingController',
            'categories' => 'CategoryController',
            'products' => 'ProductController'
        ]);


        Route::group(['middleware' => 'access.admin'], function (){


            Route::get('users/export/{type}', 'User\UserController@export')->name('users.export');
            Route::post('users/import', 'User\UserController@import')->name('users.import');
            Route::get('users/profile', 'User\UserController@profile')->name('profile');
            Route::get('users/edit-profile', 'User\UserController@editProfile')->name('edit-profile');
            Route::get('users/change-password', 'User\UserController@changePassword')->name('change-password');
            Route::post('users/store-password', 'User\UserController@storePassword')->name('store-password');


            Route::resource('users', 'User\UserController');
            Route::get('users/edit-profile', 'User\UserController@editProfile')->name('edit-profile');


            //Route::resource('configs', 'Config\ConfigController');



            Route::resource('roles', 'Roles\RoleController');

            Route::prefix('/access')->group(function() {
                /**
                 * Role access
                 */
                Route::get('/role', 'Roles\AccessModuleController@role');
                Route::get('/role/{id}', 'Roles\AccessModuleController@role_assign');
                Route::put('/role/{id}', 'Roles\AccessModuleController@role_assign_update');

                /**
                 * Access permission
                 */
                Route::get('/permission', 'Roles\AccessModuleController@permission');
                Route::get('/permission/{id}', 'Roles\AccessModuleController@permission_assign');
                Route::put('/permission/{id}', 'Roles\AccessModuleController@permission_assign_update');

            });
        });

    });
});
