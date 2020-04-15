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
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@loginProcess');
    Route::group(['middleware'=>'auth'], function() {
        Route::get('logout', 'LoginController@logout');
        Route::get('/', 'DashboardController@index');

        // Route::get('users','UserController@index');
        // Route::get('users/add','UserController@create');
        // Route::get('users/edit/{id}','UserController@edit');
        // Route::post('users/save','UserController@save');

        Route::get('buildings','BuildingController@index');
        Route::get('buildings/add','BuildingController@create');
        Route::get('buildings/edit/{id}','BuildingController@edit');
        Route::post('buildings/save/{id?}','BuildingController@save');
        Route::get('buildings/view/{id}','BuildingController@view');
        Route::post('buildings/add-contact','BuildingController@addContact');
        Route::get('buildings/delete-contact/{id}','BuildingController@deleteContact');

        Route::get('stock', 'WarehouseController@index');
        Route::get('stock/add', 'WarehouseController@create');
        Route::get('stock/edit/{id}', 'WarehouseController@edit');
        Route::post('stock/save/{id?}', 'WarehouseController@save');
        Route::get('stock/view/{id}', 'WarehouseController@view');
        Route::get('stock/add-stock/{id}', 'WarehouseController@addStock');
        Route::post('stock/add-stock/{id}', 'WarehouseController@addStockSave');

        Route::get('requirement/{type}/add', 'RequirementController@create');
        Route::get('requirement/{type}/edit/{id}', 'RequirementController@edit');
        Route::post('requirement/save/{id?}', 'RequirementController@save');
        // Route::get('requirement/update/{id}/{status}', 'RequirementController@updateStatus');
        Route::get('requirement/{type?}', 'RequirementController@index');

        Route::get('call-logs', 'CallLogController@index');
        Route::get('call-logs/add', 'CallLogController@create');
        Route::get('call-logs/edit/{id}', 'CallLogController@edit');
        Route::post('call-logs/save/{id?}', 'CallLogController@save');
        Route::get('call-logs/view/{id}', 'CallLogController@view');
        Route::get('call-logs/delete/{id}', 'CallLogController@delete');

        Route::get('notifications', 'NotificationController@index');

        Route::get('delivery/requirements', 'DeliveryController@index');
        Route::get('delivery/requirements/{id}', 'DeliveryController@viewRequirement');
        Route::get('delivery/change-status/{req_id}/{statusTo}', 'DeliveryController@changeStatus');
        Route::get('delivery/entry', 'DeliveryController@entry');
        Route::post('delivery/entry', 'DeliveryController@entrySave');

    });
});
