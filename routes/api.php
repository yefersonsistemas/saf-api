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

 Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    });
*/

// Register, Login
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\API\AuthController@login');
    Route::post('register', 'Auth\API\AuthController@register');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Auth\API\AuthController@logout');
        Route::get('user', 'API\UserController@show');
        Route::delete('user/{user}/destroy', 'API\UserController@destroy');
        Route::get('user/notifications', 'API\UserController@notifications');
    });
});
 
//rutas rol seguridad
Route::group(['prefix' => 'security'], function(){
    Route::get('/', 'API\SecurityController@index');  // se ve
    Route::POST('create', 'API\SecurityController@all_visitor');  //
    Route::POST('create/visitor', 'API\SecurityController@create_visitor');  //
    Route::POST('inside', 'API\SecurityController@statusIN');  //
    Route::POST('outside', 'API\SecurityController@statusOut');  //
    Route::POST('search', 'API\SecurityController@search');  //
});

//rutas rol recepcion
Route::group(['prefix' => 'reception'], function(){
    Route::get('/', 'API\ReceptionController@index');  //
    Route::POST('create', 'API\ReceptionController@create_history');  //
    Route::POST('search', 'API\ReceptionController@search');  //
    Route::POST('cite', 'API\ReceptionController@cite');   //
});

//rutas rol in
Route::group(['prefix' => 'in'], function(){
    Route::POST('search', 'API\InController@search');  //
    Route::POST('assigment', 'API\InController@assigment');  //
    Route::POST('create', 'API\InController@billing');  //
    Route::POST('cite', 'API\InController@cite');  //
});

//rutas rol out
Route::group(['prefix' => 'out'], function(){
    Route::POST('search', 'API\InController@buscar');  //
    Route::POST('assigment', 'API\OutController@asignacion');  //
    Route::POST('create', 'API\OutController@factura');  //
    Route::POST('cite', 'API\OutController@cite');  //
});

//rutas rol logistica
Route::group(['prefix' => 'supplie'], function(){
    Route::POST('create', 'API\LogisticController@create_supplie');  //
    Route::put('/{id}', 'LogisticController@edit_supplie');  //
    Route::delete('{supplie}', 'LogisticController@delete_supplie');  //
});

Route::group(['prefix' => 'equipment'], function(){
    Route::POST('create', 'API\LogisticController@create_equipment');  //
    Route::put('/{id}', 'LogisticController@edit_equipment');  //
    Route::delete('{equipment}', 'LogisticController@delete_equipment');  //
});

Route::group(['prefix' => 'inventory'], function(){
    Route::get('/', 'API\LogisticController@index');  // se ve
    Route::get('/', 'API\LogisticController@list_inventory');  // se ve
    Route::get('area', 'API\LogisticController@list_inventoryarea');  // se ve
});

//rutas rol doctor
Route::group(['prefix' => 'doctor'], function(){
    Route::get('/', 'API\DoctorController@index');  //se ve
    Route::get('history', 'API\DoctorController@history_patient');  //se ve
    Route::POST('create','API\DoctorController@diagnostic');  // 200 ok pero no muestra
    Route::get('recipe', 'API\DoctorController@recipe');  // se ve
});


