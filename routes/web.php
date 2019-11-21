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

    Route::group(['middleware' => ['role:recepcion']], function () {
        Route::get('cite', 'CitaController@index')->name('reservation.index');
        Route::get('cite/create','CitaController@create')->name('reservations.create');
        Route::post('search/patient','CitaController@search_patient')->name('search.patient');
    });




    Route::group(['middleware' => ['role:IN']], function () {
        Route::get('cite', 'InController@index')->name('checkin.index');
        Route::get('history/{patient_id}', 'InController@search_history')->name('checkin.history');
        Route::put('inside/{reservation}', 'InController@statusIn')->name('checkin.statusIn');
        Route::POST('outside', 'OutController@statusOut')->name('checkin.statusOut');
        Route::get('assigment', 'InController@create')->name('checkin.create');
        Route::POST('create', 'InController@store')->name('checkin.store');
        Route::get('list', 'EmployesController@doctor_on_day')->name('checkin.doctor');
       // Route::POST('assigment', 'API\InController@index')->name('checkin.assigment');
       

    });


    //======================= rutas para el usuario ckeckout ====================
    Route::group(['middleware' => ['role:OUT']], function () {
        Route::get('index', 'OutController@index')->name('checkout.index');  // para mostrar los pacientes del dia
        Route::get('cirugias_hospitalarias', 'OutController@index')->name('checkout.cirugias_hospitalarias');  // para mostrar los pacientes del dia
        Route::get('cirugias_ambulatorias', 'OutController@index')->name('checkout.cirugias_ambulatorias');  // para mostrar los pacientes del dia
        Route::get('facturacion', 'OutController@index')->name('checkout.facturacion');  // para mostrar los pacientes del dia

    });


});


    Route::group(['middleware' => ['role:doctor']], function () {
        Route::get('/', 'DoctorController@index')->name('doctor.index');
        Route::get('doctor', 'DoctorController@index')->name('doctor.index');
    });
