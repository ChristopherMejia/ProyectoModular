<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/login', 'AuthController@index');
Route::get('/logout', 'AuthController@logout');

Auth::routes(["register" => false]);

Route::get('/home', 'OrganismoController@index')->name('home');

Route::group(['middleware' => ['manager']], function () {

    Route::get('/users','UserController@index');
    Route::post('/users/create/user','UserController@store');
    Route::post('/users/get/user', 'UserController@show');
    Route::post('/users/update/user', 'UserController@update');
    Route::post('/users/delete/user', 'UserController@delete');

    Route::post('/roles/get', 'RoleController@index');

    Route::get('/organismos', 'OrganismoController@display');
    Route::post('/organismos/create', 'OrganismoController@store');
    Route::post('/organismos/get','OrganismoController@show');
    Route::post('/organismos/update', 'OrganismoController@edit');
    Route::post('/organismos/delete', 'OrganismoController@destroy');

    Route::get('/programa-educativo', 'ProgramaEducativoController@index');
    Route::post('/programa-educativo/save', 'ProgramaEducativoController@store');
    Route::post('/programa-educativo/get', 'ProgramaEducativoController@show');
    Route::post('/programa-educativo/update', 'ProgramaEducativoController@edit');
    Route::post('/programa-educativo/delete', 'ProgramaEducativoController@destroy');

    Route::get('/plantillas', 'PlantillaController@index');
    Route::post('/plantillas/get', 'PlantillaController@show'); //obtiene la plantilla
    Route::post('/plantillas/create', 'PlantillaController@create');
    Route::post('/plantilla/delete', 'PlantillaController@destroy');

    Route::post('/guia/create', 'GuiaController@create');
    Route::post('/guia/save', 'GuiaController@store');
    Route::get('/guia/iniciar/{id}', 'GuiaController@start')->name('start');
    Route::get('/guia/edit/{id}', 'GuiaController@edit');
    Route::put('/guia/update/{id}', 'GuiaController@update');
});


Route::group (['middleware' => ['coordinator']], function () {

    Route::get('/plantillas', 'PlantillaController@index'); //muestra todas las plantillas
    Route::post('/plantillas/create', 'PlantillaController@create'); //creas la plantilla
    Route::post('/plantilla/create/guia', 'PlantillaController@createGuia'); //creas la guia en base a la plantilla relacionada
    Route::post('/plantilla/save', 'PlantillaController@store');


    Route::get('/plantillas/iniciar/{id}', 'PlantillaController@start')->name('start');
    Route::get('/plantilla/edit/{id}', 'PlantillaController@edit');
    Route::put('/plantilla/update/{id}', 'PlantillaController@update');

});











