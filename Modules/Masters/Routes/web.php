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
        Route::prefix('masters')->group(function () {
            
            //category
            Route::resource('categories', 'CategoryController');
            Route::post('categories/datatable', 'CategoryController@datatable');

            //brand
            Route::resource('brands', 'BrandsController');
            Route::post('brands/datatable', 'BrandsController@datatable');
            
            //Route::delete('categories/{id}', ['as' => 'categories.destroy', 'uses' => 'CategoryController@destroy']);

            // Route::delete('categories/delete', 'CategoryController@destroy')->name('categories.delete');
        });
    });
});