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
        Route::post('cite/status', 'CitaController@status')->name('reservation.status');
    });

    Route::group(['middleware' => ['role:doctor']], function () {
        Route::get('/', 'DoctorController@index')->name('doctor.index');
        Route::get('doctor', 'DoctorController@index')->name('doctor.index');
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});
