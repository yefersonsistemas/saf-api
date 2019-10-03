<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 Route::post('login', 'API\UserController@login');
 Route::post('register', 'API\UserController@register');
 Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    });*/

//rutas rol seguridad
Route::group(['prefix' => 'security'], function(){
    Route::get('/', 'API\SecurityController@index');
    Route::POST('create', 'API\SecurityController@all_visitor');
    Route::POST('create/visitor', 'API\SecurityController@create_visitor');
    Route::POST('inside', 'API\SecurityController@statusIN');
    Route::POST('outside', 'API\SecurityController@statusOut');
    Route::POST('search', 'API\SecurityController@search');
});

//rutas rol recepcion
Route::group(['prefix' => 'reception'], function(){
    Route::get('/', 'API\ReceptionController@index');
    Route::POST('create', 'API\ReceptionController@create_history');
    Route::POST('search', 'API\ReceptionController@search');
});

//rutas rol in
Route::group(['prefix' => 'in'], function(){
    Route::POST('search', 'API\InController@search');
    Route::POST('assigment', 'API\InController@assigment');
    Route::POST('create', 'API\InController@billing');
});

//rutas rol out
Route::group(['prefix' => 'out'], function(){
    Route::POST('assigment/area', 'API\OutController@assigment');
    Route::POST('create', 'API\OutController@billing');
});

//rutas rol logistica
Route::group(['prefix' => 'supplie'], function(){
    Route::get('', 'API\LogisticController@index');
    Route::POST('create', 'API\LogisticController@create_supplie');
    Route::put('/{id}', 'LogisticController@edit_supplie');
    Route::delete('{supplie}', 'LogisticController@delete_supplie');
});

Route::group(['prefix' => 'equipment'], function(){
    Route::get('', 'API\LogisticController@index');
    Route::POST('create', 'API\LogisticController@create_equipment');
    Route::put('/{id}', 'LogisticController@edit_equipment');
    Route::delete('{equipment}', 'LogisticController@delete_equipment');
});

Route::group(['prefix' => 'inventory'], function(){
    Route::get('', 'API\LogisticController@list_inventory');
    Route::get('', 'API\LogisticController@list_inventoryarea');
});


