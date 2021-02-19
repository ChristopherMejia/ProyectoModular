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

Route::get('/login', 'AuthController@index');
Route::get('/logout', 'AuthController@logout');

Auth::routes(["register" => false]);

Route::get('/home', 'OrganismoController@index')->name('home');

Route::get('/organismo', 'OrganismoController@create');
Route::post('/organismo/save', 'OrganismoController@store');
Route::get('/organismo/show','OrganismoController@show');
Route::get('/organismo/edit/{id}', 'OrganismoController@edit');
Route::get('/organismo/delete/{id}', 'OrganismoController@destroy');


Route::get('/plantilla', 'PlantillaController@create');
Route::post('/plantilla/save', 'PlantillaController@store');

