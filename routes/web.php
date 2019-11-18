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


//agrupando rutas con
Route::group(['middleware' => 'auth'], function (){

    Route::group(['middleware' => ['role:recepcion']], function () {
        Route::get('cite', 'CitaController@index')->name('reservation.index');

    });















});


//======================= rutas para el usuario ckeckout ====================
Route::group(['middleware' => 'checkout'], function (){

    Route::get('index', 'Patient_Controller@index')->name('checkout.index');;  // para mostrar los pacientes del dia


});
