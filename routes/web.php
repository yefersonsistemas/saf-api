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

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');



Route::group(['middleware' => 'auth'], function (){

    Route::group(['middleware' => ['role:recepcion']], function () {
        Route::get('cite', 'CitaController@index')->name('reservation.index');
        Route::get('cite/create','CitaController@create')->name('reservations.create');
    });


    //======================= rutas para el usuario ckeckout ====================
    Route::group(['middleware' => ['role:OUT']], function () {
        Route::get('index', 'OutController@index')->name('checkout.index');  // para mostrar los pacientes del dia
        Route::get('cirugias_hospitalarias', 'OutController@index')->name('checkout.cirugias_hospitalarias');  // para mostrar los pacientes del dia
        Route::get('cirugias_ambulatorias', 'OutController@index')->name('checkout.cirugias_ambulatorias');  // para mostrar los pacientes del dia
        Route::get('facturacion', 'OutController@index')->name('checkout.facturacion');  // para mostrar los pacientes del dia

    });



});


