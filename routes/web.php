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


Route::get('/', 'PreguntaController@index')->name('index');

Route::get('/mes', 'PreguntaController@mes')->name('index.mes');
Route::get('/activas', 'PreguntaController@activas')->name('index.activas');
Route::get('/populares', 'PreguntaController@populares')->name('index.populares');
Route::get('/hoy', 'PreguntaController@dia')->name('index.hoy');
Route::get('/semana', 'PreguntaController@semana')->name('index.semana');
Route::get('/reciente', 'PreguntaController@reciente')->name('index.reciente');


Auth::routes();

/**
 * Rutas de inicio de sesion con google
 */
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/create', 'PreguntaController@create')->name('pregunta.create');
Route::get('/profile', 'PreguntaController@show')->name('user.profile');

Route::post('/', 'PreguntaController@store')->name('pregunta.store');

// buscador
Route::get('buscar','PreguntaController@index')->name('index.buscar');
