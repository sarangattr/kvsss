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
            Route::get('change-category-status','CategoryController@changeStatus');

            //brand
            Route::resource('brands', 'BrandsController');
            Route::post('brands/datatable', 'BrandsController@datatable');
            Route::get('change-brands-status','BrandsController@changeStatus');

            //tags
            Route::resource('tags','TagsController');
            Route::post('tags/datatable','TagsController@datatable');
            Route::get('change-tags-status','TagsController@changeStatus');

            //models
            Route::resource('models','ModelController');
            Route::post('models/datatable','ModelController@datatable');
            Route::get('change-models-status','ModelController@changeStatus');

            //stores
            Route::resource('stores','StoreController');
            Route::post('stores/datatable','StoreController@datatable');
            Route::get('change-stores-status','StoreController@changeStatus');

            //tray
            Route::resource('trays','TrayController');
            Route::post('trays/datatable','TrayController@datatable');
            Route::get('change-trays-status','TrayController@changeStatus');
            
        });
    });
});
