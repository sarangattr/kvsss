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
        Route::resource('set-top-box', 'SetTopBoxController');
        Route::post('set-top-box/datatable', 'SetTopBoxController@datatable');
        Route::get('change-set-top-box-status', 'SetTopBoxController@changeStatus');
        Route::get('get-sub-dis', 'SetTopBoxController@getSubDis');
    });
});
