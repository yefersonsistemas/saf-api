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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');



Route::group(['middleware' => 'auth'], function (){

     //======================= rutas para el usuario recepcion ====================
    Route::group(['middleware' => ['role:recepcion']], function () {
        Route::get('cite', 'CitaController@index')->name('reservation.index');
        Route::get('cite/create','CitaController@create')->name('reservations.create');
    });



     //======================= rutas para el usuario ckeckin ====================
    Route::group(['middleware' => ['role:IN']], function () {
        Route::get('cite', 'InController@index')->name('checkin.index');
        Route::get('', 'InController@create')->name('checkin.create');
        //Route::get('', 'EmployesController@all_doctors')->name('checkin.doctor');
        Route::POST('assigment', 'API\InController@index')->name('checkin.assigment');
        // Route::put('update', 'API\InController@update_area');  // listo
        // Route::POST('inside', 'API\InController@statusIn'); //creacion de registro

    });


    //======================= rutas para el usuario ckeckout ====================
    Route::group(['middleware' => ['role:OUT']], function () {
        Route::get('ken', 'OutController@index')->name('checkout.index');  // mostrar pacientes del dia
        Route::get('cirugias', 'OutController@index_cirugias')->name('checkout.index_cirugias');  // mostrar cirugias
        Route::get('cirugias/detalles/{id}', 'OutController@cirugias_detalles')->name('checkout.cirugias_detalles');  // detalles de cirugias
        Route::get('facturacion', 'OutController@create')->name('checkout.facturacion');  // generar factura
        Route::get('factura', 'OutController@create_factura')->name('checkout.factura');  // mostrar factura

    });



});


