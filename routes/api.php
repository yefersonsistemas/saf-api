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
 Route::post('login', 'API\UserController@login');
 Route::post('register', 'API\UserController@register');
 Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    });*/

Route::group(['prefix' => 'security'], function(){
    Route::get('/', 'API\SecurityController@index');
    Route::POST('create', 'API\SecurityController@all_visitor');
    Route::POST('create/visitor', 'API\SecurityController@create_visitor');
    Route::POST('inside', 'API\SecurityController@statusIN');
    Route::POST('outside', 'API\SecurityController@statusOut');
    Route::POST('search', 'API\SecurityController@search');
    });

Route::group(['prefix' => 'reception'], function(){
    Route::get('/', 'API\ReceptionController@index');
    Route::POST('create', 'API\ReceptionController@create_history');
    Route::POST('search', 'API\ReceptionController@search');
});

Route::group(['prefix' => 'in'], function(){
    Route::POST('assigment/area', 'API\InController@assigment');
    Route::POST('create', 'API\InController@billing');
});

