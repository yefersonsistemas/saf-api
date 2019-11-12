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


        // Route::group(['prefix' => 'patients'], function(){
        //     Route::get('/', 'API\PatientController@index');
        //     Route::get('/list','API\PatientController@list');
        // });
        
        Route::group(['prefix' => 'payments'], function(){
            Route::get('/type', 'API\PaymentController@index');
        });
        
        Route::group(['prefix' => 'areas'], function(){
            Route::get('/type', 'API\AreasController@type');
        });
        
        
        //rutas rol seguridad
        Route::group(['prefix' => 'security'], function(){
            Route::get('/', 'API\SecurityController@index');  // se ve
            Route::POST('create', 'API\SecurityController@all_visitor');  // corregido funciona bien
            Route::POST('create/person', 'API\SecurityController@only_person'); // registra solo en person
            Route::POST('create/visitor', 'API\SecurityController@create_visitor');  // listo
            Route::POST('inside', 'API\SecurityController@statusIn');  // corregido funciona bien
            Route::POST('outside', 'API\SecurityController@statusOut');  // corregido funciona bien
            Route::POST('search', 'API\SecurityController@search');  // corregido funciona bien
        });

        //rutas rol recepcion
        Route::group(['prefix' => 'reception'], function(){
            Route::get('/', 'API\ReceptionController@index');  // listo
            Route::get('list', 'API\ReceptionController@list_reception');
            Route::POST('cite/patient', 'API\ReceptionController@cite_patient');
            Route::POST('cancel', 'API\ReceptionController@cancel'); //cancela/suspende la cita
            Route::POST('discontinued', 'API\ReceptionController@discontinued');
            Route::POST('approved', 'API\ReceptionController@approved');
            Route::POST('reason', 'API\ReceptionController@reason');
            Route::POST('surgeries', 'API\SurgerysController@surgeries'); //muestra todas las cirugias por medico
            Route::POST('create', 'API\ReceptionController@create_history');  //lissto.
            Route::POST('update', 'API\PersonController@update_person');
            Route::POST('update/patient', 'API\PatientController@update_patient');
            Route::POST('search', 'API\ReceptionController@search');  // listo 
            Route::get('list/discontinued', 'API\ReceptionController@list_S');
            Route::get('list/cancel', 'API\ReceptionController@list_C');
            Route::POST('delete', 'API\ReceptionController@delete_cite');
            Route::get('reservation', 'API\ReceptionController@list_R');
        });

        //rutas generar cita/reservacion
        Route::group(['prefix' => 'cite'], function(){
            Route::POST('create', 'API\CitaController@create_cite'); //listo
            Route::POST('reschedule', 'API\CitaController@only_id');//id para reprogramar cita
            Route::POST('update', 'API\CitaController@update_cite'); // listo
            Route::delete('delete/{id}', 'API\CitaController@delete_cite');  //listo
            Route::POST('search', 'API\CitaController@search');  //buscar persona para luego agendar cita 1era vez
            Route::POST('search/speciality', 'API\CitaController@search_doctor');
            Route::POST('search/schedule', 'API\CitaController@search_schedule');
        });

        //rutas rol in y out
        Route::group(['prefix' => 'in'], function(){
            Route::POST('search', 'API\InController@search');  // listo
            Route::get('search/area', 'API\AreasController@search_area');
            Route::POST('assigment', 'API\InController@assigment');  // asignar consultorio listo
            //Route::POST('area', 'API\InController@status');  // listo
            Route::get('list', 'API\AreasController@list_area');  // listo
            Route::POST('inside', 'API\InController@statusIn'); //creacion de registro
        });

        Route::group(['prefix' => 'out'], function(){
            Route::get('/', 'API\PatientController@index'); //todos los pacientes
            Route::get('all/doctors','API\EmployesController@all_doctors');  //todos los doctores en el sistema
            Route::POST('search', 'API\CitaController@search'); //busca persona a ver si existe
            Route::POST('create/person', 'API\SecurityController@only_person'); // persona a cancelar en caso de no ser el paciente
            Route::get('list','API\EmployesController@list'); //medicos con sus procedimientos
            Route::POST('doctor','API\OutController@doctor_P');// procedimientos segun el medico
            Route::POST('search/patient', 'API\PatientController@search'); //busca paciente q estara en la factura
            Route::get('pay', 'API\OutController@payment');  //tipo de pago
            Route::get('currency', 'API\OutController@currency');  //tipo de moneda
            Route::POST('create', 'API\OutController@billing');  // listo 
            Route::POST('outside', 'API\OutController@statusOut'); //actualizacion de registro
            Route::get('print/exam', 'API\OutController@exams');  //examenes que debe realizarce el paciente
            Route::get('print/recipe', 'API\OutController@recipe');
        });



        //rutas rol logistica
        Route::group(['prefix' => 'supplie'], function(){
            Route::get('type', 'API\SupplieController@type');
            Route::POST('create', 'API\LogisticController@create_supplie');  // listo
            Route::put('/{id}', 'API\LogisticController@edit_supplie');  // listo
            Route::delete('delete/{id}', 'API\LogisticController@delete_supplie');  // listo 
        });
        
        Route::group(['prefix' => 'equipment'], function(){
            Route::get('type', 'API\EquipmentController@type');
            Route::POST('create', 'API\LogisticController@create_equipment');  // listo
            Route::put('/{id}', 'API\LogisticController@edit_equipment');  // listo
            Route::delete('delete/{id}', 'API\LogisticController@delete_equipment');  //listo
        });
        
        Route::group(['prefix' => 'inventory'], function(){
            Route::get('list', 'API\LogisticController@index');  // esta muestra insumos y equipos
            Route::get('/', 'API\InventorysController@list_inventory');  // muestra todo el inventario
            Route::get('area', 'API\InventoryAreasController@list_inventoryarea');  // inventario por area y su img
            Route::get('supplie', 'API\SupplieController@list_supplie');  // muestra inventario solo de insumos
            Route::get('equipment', 'API\EquipmentController@list_equipment');  // muestra inventario solo de equipos
            Route::POST('escoger/supplie', 'API\LogisticController@escogerS');
            Route::POST('escoger/equipment', 'API\LogisticController@escogerE');
            Route::POST('assigment', 'API\LogisticController@assigment'); //
            Route::POST('cleaning', 'API\TypeCleaningController@registercleanig');
            Route::get('record/cleaning', 'API\CleaningRecordController@record_cleaning');
        });
        
        //rutas rol doctor
        Route::group(['prefix' => 'doctor'], function(){
            Route::get('list', 'API\EmployesController@index');  //lista de empleados que trabajaran en el dia
            Route::get('/', 'API\PatientController@index');  //muestra todos los pacientes
            //Route::get('history', 'API\EmployesController@history_patient');  //se ve
            Route::POST('create','API\EmployesController@diagnostic');  // listo
            Route::POST('recipe', 'API\EmployesController@recipe');  // se ve
            Route::POST('pay', 'API\EmployesController@calculo_week');  // 
        });
        
        Route::group(['prefix' => 'stocktaking'], function()
        {
            //Insumos
            Route::get('/', 'API\StocktakingController@index');
            Route::post('/create_supplie', 'API\StocktakingController@create_supplie');
            Route::PUT('/edit_supplie', 'API\StocktakingController@edit_supplie');
            
            //Equipo
            Route::post('/create_equipment', 'API\StocktakingController@create_equipment');
            Route::put('/edit_equipment', 'API\StocktakingController@edit_equipment');
        });
        
        Route::group(['prefix' => 'create'], function(){
            Route::POST('procedure', 'API\ProcedureController@store');
            Route::POST('exam', 'API\ExamController@store');
            Route::get('positions', 'API\EmployesController@positions');
            Route::get('speciality', 'API\CitaController@speciality');
            Route::POST('create/speciality', 'API\SpecialityController@store');
            
        });
        
        Route::group(['prefix' => 'employe'], function(){
            Route::get('/', 'API\EmployesController@index');  // listo
            Route::get('/list','API\EmployesController@list');  //muestra todos los medicos con procedimientos
            Route::get('all/doctors','API\EmployesController@all_doctors'); //todos los medicos 
            Route::get('doctor/onday','API\EmployesController@doctor_on_day'); //medicos del dia
            Route::POST('create', 'API\EmployesController@store');  // listo
            Route::POST('inside', 'API\EmployesController@statusIn');  //listo
            Route::POST('outside', 'API\SecurityController@statusOut');  //listo
            Route::POST('assistance', 'API\EmployesController@assistance');
        });
        
        //rutas para la App
        Route::group(['prefix' => 'patient'], function(){
            Route::POST('record/cites', 'API\PatientController@record_cite');
            Route::POST('record','API\EmployesController@record_patient');
            Route::POST('date', 'API\EmployesController@patient_on_day');
            Route::POST('details', 'API\EmployesController@detail_doctor');
        });
        //});
        
        
        