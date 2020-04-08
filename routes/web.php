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

Route::namespace('Admin')->group(function(){
    Route::get('login', 'LoginController@login');
    Route::post('login', 'LoginController@loginProcess');
    
    // Route::group(['middleware'=>'auth'], function() {
        Route::get('logout', 'LoginController@logout');
        Route::get('/', 'DashboardController@dashboard');

        // Route::get('users','UserController@index');
        // Route::get('users/add','UserController@create');
        // Route::get('users/edit/{id}','UserController@edit');
        // Route::post('users/save','UserController@save');

        Route::get('buildings','BuildingController@index');
        Route::get('buildings/add','BuildingController@create');
        Route::get('buildings/edit/{id}','BuildingController@edit');
        Route::post('buildings/save','BuildingController@save');
        Route::get('buildings/view/{id}','BuildingController@view');

        Route::get('warehouse', 'WarehouseController@index');
        Route::get('warehouse/add', 'WarehouseController@create');
        Route::get('warehouse/edit/{id}', 'WarehouseController@edit');
        Route::post('warehouse/save', 'WarehouseController@save');
        Route::get('warehouse/view/{id}', 'WarehouseController@view');

    // });
});
