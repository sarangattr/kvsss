<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 

Route::prefix('admin')->group(function () {
    
    Route::group(['middleware' => ['auth']], function () {

        Route::resource('dashboard', 'DashboardController');

        //users crud
        Route::resource('/users', 'UserController');
        Route::post('/users/datatable', 'UserController@datatable');

        //roles crud
        Route::resource('/roles','RolesController'); 
        Route::post('/roles/datatable','RolesController@datatable');

        //permissions crud
        Route::resource('/permissions','PermissionsController');
        Route::post('/permissions/datatable','PermissionsController@datatable');

        //
        Route::get('/forgot-password', 'ApplicationController@forgotPassword');
        Route::post('/reset-password', 'ApplicationController@resetPassword')->name('reset.password');
        Route::post('/update-password', 'ApplicationController@updatePassword')->name('update.password');

        //firebase notification
        Route::post('/save-token', 'ApplicationController@saveToken')->name('save.token');
        Route::post('/send-notification', 'ApplicationController@sendNotification')->name('send.notification');

        Route::get('/reset-old-password', 'ApplicationController@resetOldPassword')->name('reset.oldpassword');
        Route::post('/update-old-password', 'ApplicationController@updateOldPassword')->name('update.old-password');
        
    });
});

Route::get('/application/pincode/{pincode}', 'ApplicationController@getPincode');

