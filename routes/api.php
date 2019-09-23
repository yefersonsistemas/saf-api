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

Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

/*
Auth::routes();

Route::get('/sedes', 'API\HeadquartersController@create');

Route::group(['middleware' => ['auth']], function () { 

    Route::group(['prefix' => 'dashboard'], function () { 

        Route::group(['prefix' => 'patients'], function () {
            
            
          
        });

    });
});*/