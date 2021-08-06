<?php

Route::get('/login', 'AuthController@index');
Route::get('/logout', 'AuthController@logout');

Auth::routes(["register" => false]);

Route::get('/home', 'OrganismoController@index')->name('home');

Route::group(['middleware' => ['manager']], function () {
    Route::resource('/users', 'UserController');

    Route::get('/organismo', 'OrganismoController@create');
    Route::post('/organismo/save', 'OrganismoController@store');
    Route::get('/organismo/show','OrganismoController@show');
    Route::post('/organismo/edit', 'OrganismoController@edit');
    Route::post('/organismo/delete', 'OrganismoController@destroy');

    Route::get('/programa-educativo', 'ProgramaEducativoController@index');
    Route::post('/programa-educativo/save', 'ProgramaEducativoController@store');
    Route::get('/programa-educativo/show', 'ProgramaEducativoController@show');
    Route::post('/programa-educativo/edit', 'ProgramaEducativoController@edit');
    Route::post('/programa-educativo/delete', 'ProgramaEducativoController@destroy');
});


Route::group (['middleware' => ['coordinator']], function () {

    Route::get('/plantilla', 'PlantillaController@index');
    Route::get('/plantilla/create', 'PlantillaController@create');
    Route::post('/plantilla/save', 'PlantillaController@store');
    Route::get('/plantilla/start/{id}', 'PlantillaController@start');
    Route::get('/plantilla/edit/{id}', 'PlantillaController@edit');
    Route::put('/plantilla/update/{id}', 'PlantillaController@update');
    
});

  
    
    
    
    
   
    
    


