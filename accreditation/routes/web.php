<?php

Route::get('/login', 'AuthController@index');
Route::get('/logout', 'AuthController@logout');

Auth::routes(["register" => false]);

Route::get('/home', 'OrganismoController@index')->name('home');

Route::resource('users', 'UserController');

Route::get('/organismo', 'OrganismoController@create');
Route::post('/organismo/save', 'OrganismoController@store');
Route::get('/organismo/show','OrganismoController@show');
Route::post('/organismo/edit', 'OrganismoController@edit');
Route::post('/organismo/delete', 'OrganismoController@destroy');

Route::get('/plantilla', 'PlantillaController@index');
Route::get('/plantilla/create', 'PlantillaController@create');
Route::post('/plantilla/save', 'PlantillaController@store');
Route::get('/plantilla/start/{id}', 'PlantillaController@start');

Route::get('/programa-educativo', 'ProgramaEducativoController@index');
Route::post('/programa-educativo/save', 'ProgramaEducativoController@store');
Route::get('/programa-educativo/show', 'ProgramaEducativoController@show');
Route::post('/programa-educativo/edit', 'ProgramaEducativoController@edit');
Route::post('/programa-educativo/delete', 'ProgramaEducativoController@destroy');


