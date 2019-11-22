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

    Route::post('person','PersonController@store')->name('person.create');
    Route::post('search/doctor','DoctorController@searchDoctor')->name('search.medic');
    Route::post('search/doctor/schedule','DoctorController@search_schedule')->name('search.schedule');

    Route::group(['middleware' => ['role:recepcion']], function () {
        Route::get('cite', 'CitaController@index')->name('reservation.index');
        Route::get('cite/create','CitaController@create')->name('reservations.create');
        Route::post('search/patient','CitaController@search_patient')->name('search.patient');
        Route::post('cite','CitaController@store')->name('reservation.store');
    });



     //======================= rutas para el usuario ckeckin ====================
    Route::group(['middleware' => ['role:IN']], function () {
        Route::get('cite', 'InController@index')->name('checkin.index');
        Route::get('history/{patient_id}', 'InController@search_history')->name('checkin.history');
        Route::POST('save', 'InController@save_data')->name('checkin.save');
        Route::get('inside/{registro}', 'InController@statusIn')->name('checkin.statusIn'); // cambia estado depaciente a dentro del consultorio
        Route::get('outside/{id}', 'OutController@statusOut')->name('checkin.statusOut'); // cambia estado depaciente a fuera del consultorio
        Route::get('assigment', 'InController@create')->name('checkin.create');
        Route::POST('create', 'InController@store')->name('checkin.store');
        Route::get('list', 'EmployesController@doctor_on_day')->name('checkin.doctor');
        //Route::POST('file/{id}', 'InController@exams_previos')->name('checkin.exams');
       // Route::POST('assigment', 'API\InController@index')->name('checkin.assigment');
       

    });


    //======================= rutas para el usuario ckeckout ====================
    Route::group(['middleware' => ['role:OUT']], function () {
        Route::get('ken', 'OutController@index')->name('checkout.index');  // mostrar pacientes del dia
        Route::get('cirugias', 'OutController@index_cirugias')->name('checkout.index_cirugias');  // mostrar cirugias
        Route::get('cirugias/detalles/{id}', 'OutController@cirugias_detalles')->name('checkout.cirugias_detalles');  // detalles de cirugias
        Route::get('facturacion', 'OutController@create')->name('checkout.facturacion');  // generar factura

       
        Route::post('search/patient','OutController@search_patient')->name('checkout.patient'); //buscar paciente

        Route::get('factura', 'OutController@create_factura')->name('checkout.factura');  // mostrar factura

    });

    Route::group(['middleware' => ['role:doctor']], function () {
        Route::get('/', 'DoctorController@index')->name('doctor.index');
        // Route::get('doctor', 'DoctorController@index')->name('doctor.index');
        // Route::get('doctor/store', 'DoctorController@store')->name('doctor.index');
        Route::get('doctor/diagnostico','DoctorController@crearDiagnostico')->name('doctor.crearDiagnostico');
        Route::get('doctor/recipe','DoctorController@crearRecipe')->name('doctor.crearRecipe');
        Route::get('doctor/Referencia','DoctorController@crearReferencia')->name('doctor.crearReferencia');
        Route::resource('doctor', 'DoctorController');
    });
});
