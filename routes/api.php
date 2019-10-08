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

Route::group(['prefix' => 'patients'], function(){
    Route::get('/', 'API\PatientController@index');
    Route::get('/list','API\PatientController@list');
});

Route::group(['prefix' => 'doctors'], function(){
    Route::get('/', 'API\DoctorController@index');
    Route::get('/list','API\DoctorController@list');
});

Route::group(['prefix' => 'payments'], function(){
    Route::get('/type', 'API\PaymentController@index');
});

Route::group(['prefix' => 'areas'], function(){
    Route::get('/type', 'API\AreasController@type');
});

Route::group(['prefix' => 'supplies'], function(){
    Route::get('/type', 'API\SupplieController@type');
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
    Route::get('/', 'API\ReceptionController@index');  // listo
    Route::POST('create', 'API\ReceptionController@create_history');  //
    Route::POST('search', 'API\ReceptionController@search');  // listo
});

//rutas generar cita/reservacion
Route::group(['prefix' => 'cite'], function(){
    Route::POST('create', 'API\CitaController@create_cite'); //listo
    Route::put('/{id}', 'API\CitaController@update_cite');
    Route::delete('delete/{id}', 'API\CitaController@delete_cite');
});

//rutas rol in y out
Route::group(['prefix' => 'IO'], function(){
    Route::POST('search', 'API\InController@search');  // listo
    Route::POST('assigment', 'API\InController@assigment');  // 
    Route::POST('create', 'API\InController@billing');  // listo 
});

//rutas rol logistica
Route::group(['prefix' => 'supplie'], function(){
    Route::POST('create', 'API\LogisticController@create_supplie');  // 200 ok
    Route::put('/{id}', 'API\LogisticController@edit_supplie');  // 200 ok
    Route::delete('delete/{id}', 'API\LogisticController@delete_supplie');  // listo
    Route::POST('assigment/supplie', 'API\LogisticController@assigment_supplie'); //
});

Route::group(['prefix' => 'equipment'], function(){
    Route::POST('create', 'API\LogisticController@create_equipment');  // listo
    Route::put('/{id}', 'API\LogisticController@edit_equipment');  // listo
    Route::delete('delete/{id}', 'API\LogisticController@delete_equipment');  //listo
    Route::POST('assigment/equipment', 'API\LogisticController@assigment_equipment'); //
});

Route::group(['prefix' => 'inventory'], function(){
    Route::get('list', 'API\LogisticController@index');  // se ve
    Route::get('/', 'API\LogisticController@list_inventory');  // se ve
    Route::get('area', 'API\LogisticController@list_inventoryarea');  // se ve
});

//rutas rol doctor
Route::group(['prefix' => 'doctor'], function(){
    Route::get('/', 'API\DoctorController@index');  //se ve
    Route::get('list', 'API\DoctorController@list'); //se ve
    Route::get('history', 'API\DoctorController@history_patient');  //se ve
    Route::POST('create','API\DoctorController@diagnostic');  // 200 ok pero no muestra
    Route::get('recipe', 'API\DoctorController@recipe');  // se ve
});


