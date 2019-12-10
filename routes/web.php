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
Route::get('/', function() {
    return redirect()->route('login');
})->name('welcome');

Auth::routes();


Route::group(['middleware' => 'auth'], function (){

    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::post('person','PersonController@store')->name('person.create');
    Route::post('search/doctor','DoctorController@searchDoctor')->name('search.medic');
    Route::post('search/doctor/schedule','DoctorController@search_schedule')->name('search.schedule');
    Route::get('outside/{id}', 'OutController@statusOut')->name('checkout.statusOut'); // cambia estado depaciente a fuera del consultorio


    Route::get('doctor/recipe/{patient}/{employe}','DoctorController@crearRecipe')->name('doctor.crearRecipe');
    Route::post('doctor/recipe/{patient}/{employe}','DoctorController@recipeStore')->name('recipe.store');


    Route::group(['middleware' => ['role:recepcion']], function () {
        Route::get('citas', 'CitaController@index')->name('citas.index');
    });

     //======================= rutas para el usuario ckeckin ====================
    Route::group(['middleware' => ['role:IN']], function () {
        Route::get('cite', 'InController@index')->name('checkin.index');
        Route::get('history/{patient_id}', 'InController@search_history')->name('checkin.history');
        Route::post('assigment/area', 'InController@assigment')->name('checkin.assigment');
        Route::post('search/area','InController@search_area')->name('search.area');  //revisa si el area esta ocupada
        Route::post('search/medico','InController@search_medico')->name('search.medico');  //busca los doctores
        Route::get('inside/{registro}', 'InController@statusIn')->name('checkin.statusIn'); // cambia estado depaciente a dentro del consultorio
        Route::get('insideOffice/{id}', 'InController@insideOffice')->name('checkin.insideOffice'); // cambia estado depaciente a dentro del consultorio
        Route::get('assigment', 'InController@create')->name('checkin.create');
        Route::post('assigment/create', 'InController@assigment_area')->name('checkin.assigment_area');
        Route::post('create', 'InController@store')->name('checkin.store');
        Route::get('list', 'EmployesController@doctor_on_day')->name('checkin.doctor');
        Route::post('Doctor/asistencia', 'EmployesController@assistance')->name('checkin.asistencia');
        Route::post('horario', 'InController@horario')->name('checkin.horario');
        Route::POST('save/{id}', 'InController@guardar')->name('save.history');
        Route::post('status', 'InController@status')->name('checkin.status');
 

        // Recepcion
        Route::get('cite/create','CitaController@create')->name('reservations.create');
        Route::get('cite/edit/{cite}','CitaController@edit')->name('reservation.edit');
        Route::post('search/reception/patient','CitaController@search_patient')->name('search.patient');
        Route::post('cite/store','CitaController@store')->name('reservation.store');
        Route::post('cite/status', 'CitaController@status')->name('reservation.status');
        
        Route::put('cite/edit/{cite}','CitaController@update')->name('reservations.update');
        Route::get('patient/create/{reservation}', 'CitaController@createHistory')->name('patients.generate');
        Route::post('patient/create/{reservation}','CitaController@storeHistory')->name('patients.store');
    });


    //======================= rutas para el usuario ckeckout ====================
    Route::group(['middleware' => ['role:OUT']], function () {
        Route::get('index', 'OutController@index')->name('checkout.index');                          // mostrar pacientes del dia
        Route::get('cirugias', 'OutController@index_cirugias')->name('checkout.index_cirugias');   // mostrar cirugias
        Route::get('cirugias/detalles/{id}', 'OutController@cirugias_detalles')->name('checkout.cirugias_detalles');  // detalles de cirugias
        Route::get('facturacion', 'OutController@create')->name('checkout.facturacion');           // para generar factura
        Route::post('search/patient','OutController@search_patient')->name('checkout.patient');    // buscar paciente    
        Route::post('factura/generar', 'OutController@guardar_factura')->name('checkout.guardar_factura');  // guardando datos del P/D/P
        Route::get('procedimiento/{registro}', 'OutController@search_procedure')->name('checkout.search_procedure');  // buscar procedimiento

        Route::POST('registro', 'OutController@create_cliente')->name('checkout.person');           // mostrar factura
        Route::post('imprimir', 'OutController@imprimir_factura')->name('checkout.imprimir_factura');           // mostrar factura

        Route::get('imprimir/examen/{id}', 'OutController@imprimir_examen')->name('checkout.imprimir_examen');           // imprimir examen
        Route::get('imprimir/recipe/{id}', 'OutController@imprimir_recipe')->name('checkout.imprimir_recipe');           // imprimir recipe
        Route::get('generar/examen/{patient}','OutController@crearExamen')->name('checkout.crear_examen');
        Route::post('guardar/examens/{patient}','OutController@storeDiagnostic')->name('checkout.diagnostic.store');
        Route::get('constancia','OutController@imprimir_constancia')->name('checkout.imprimir_constancia');
        Route::get('reposo','OutController@imprimir_reposo')->name('checkout.imprimir_reposo');
        Route::get('referencia','OutController@imprimir_referencia')->name('checkout.imprimir_referencia');
    });

    Route::group(['middleware' => ['role:doctor']], function () {
        Route::get('/doctor', 'DoctorController@index')->name('doctor.index');
        // Route::get('doctor', 'DoctorController@index')->name('doctor.index');
        // Route::get('doctor/store', 'DoctorController@store')->name('doctor.index');
        Route::get('doctor/diagnostico/{patient}','DoctorController@crearDiagnostico')->name('doctor.crearDiagnostico');
        Route::post('doctor/diagnostico/{patient}','DoctorController@storeDiagnostic')->name('diagnostic.store');
        Route::get('doctor/Referencia/{patient}','DoctorController@crearReferencia')->name('doctor.crearReferencia');
        Route::resource('doctor', 'DoctorController');
        Route::post('doctor/Referencia/{patient}','DoctorController@referenceStore')->name('reference.store');
    });
});
