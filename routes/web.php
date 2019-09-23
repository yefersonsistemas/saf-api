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

Route::get('/home', 'HomeController@index')->name('home');

//Rutas del saf viejo
/**
 * Todas las rutas del dashboard
 */
Route::group(['prefix' => 'dashboard'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

Route::resource('users', 'UserController');
Route::resource('patients', 'PatientController');
Route::get('sales/procedure/{doctor}', 'SaleController@doctorProcedure')->name('sale.procedure'); //Procedure by doctor
Route::resource('sales', 'SaleController');
// Rutas para los pacientes
Route::group(['prefix' => 'patients'], function () {
    // Listado de todos los pacientes
    Route::get('/', 'PatientController@index')->name('patients.index');
    Route::get('/create', 'PatientController@create')->name('patients.create');
    Route::post('/store', 'PatientController@store')->name('patients.store');
    

        // Grupo creado para gestionar correctamente los diagnosticos de un paciente en especifico
        Route::group(['prefix' => '{patient}'], function () {

        //Mostrar un paciente
        Route::get('/show', 'PatientController@show')->name('patients.show');
        Route::post('/edit', 'PatientController@edit')->name('patients.edit');
        Route::post('/update', 'PatientController@update')->name('patients.update');
        Route::get('/recipe', 'PatientController@recipe')->name('patients.recipe');
        Route::post('/pdfPatient', 'PatientController@pdfPatient')->name('patients.pdfPatient');


        // Grupo para los diagnosticos de un paciente
            Route::group(['prefix' => 'diagnostics'], function () {
                Route::post('/', 'DiagnosticController@index')->name('diagnostics.index');
                Route::post('/', 'DiagnosticController@store')->name('diagnostics.store');
                Route::get('/create', 'DiagnosticController@create')->name('diagnostics.create')->middleware('permission:create diagnostics');
            });
        });
        Route::get('diagnostic/{diagnostic}', 'DiagnosticController@show')->name('diagnostics.show'); 
    });
    // ruta de los procedimientos
    Route::group(['prefix' => 'procedures'], function () {
        Route::get('/', 'ProcedureController@index')->name('procedures.index');
        Route::get('/create/{doctor}', 'ProcedureController@create')->name('procedures.create');
        Route::get('/edit/{procedure}', 'ProcedureController@edit')->name('procedures.edit');
        Route::post('/store/{doctor}', 'ProcedureController@store')->name('procedures.store');
        Route::post('/update/{procedure}', 'ProcedureController@update')->name('procedures.update');
        Route::delete('/delete/{procedure}','ProcedureController@destroy')->name('procedures.destroy');
    });
    
    // Rutas para todo lo relacionado con la configuracion del sistema 
    Route::group(['prefix' => 'configuration'], function () {
        Route::get('/', 'ConfigurationController@index')->name('configuration.index');
        Route::put('/{user}','ConfigurationController@personalUpdate')->name('personal.update');
        Route::get('/priceDolar','ConfigurationController@dolarPrice')->name('configuration.dolar');
        Route::put('/priceDolar/{dolar}','ConfigurationController@dolarUpdate')->name('configuration.dolarUpdate');
    });
});
