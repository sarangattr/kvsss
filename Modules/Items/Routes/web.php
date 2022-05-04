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

Route::prefix('admin')->group(function() {
    Route::group(['middleware' => ['auth']], function () {  
        //category
        Route::resource('items', 'ItemsController');
        Route::post('items/datatable', 'ItemsController@datatable');
        Route::get('change-items-status','ItemsController@changeStatus');
    });
});
