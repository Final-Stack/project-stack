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

// Index
Route::get('/', 'PreguntaController@index')->name('index');

Route::get('/mes', 'PreguntaController@mes')->name('index.mes');
Route::get('/activas', 'PreguntaController@activas')->name('index.activas');
Route::get('/populares', 'PreguntaController@populares')->name('index.populares');
Route::get('/hoy', 'PreguntaController@dia')->name('index.hoy');
Route::get('/semana', 'PreguntaController@semana')->name('index.semana');
Route::get('/reciente', 'PreguntaController@reciente')->name('index.reciente');

//Busqueda de usuarios
Route::get('/users', 'UserController@index')->name('users');

Route::get('/users/reciente', 'UserController@reciente')->name('users.reciente');
Route::get('/users/preguntas', 'UserController@preguntas')->name('users.preguntas');
Route::get('/users/respuestas', 'UserController@respuestas')->name('users.respuestas');

Auth::routes();

/**
 * Rutas de inicio de sesion con google
 */
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/create', 'PreguntaController@create')->name('pregunta.create');
Route::get('/user/{id}', 'UserController@show')->name('user.profile');
Route::get('/preguntas/{id}', 'PreguntaController@show')->name('pregunta.show');

Route::post('/', 'PreguntaController@store')->name('pregunta.store');

// Buscador Index
Route::get('buscar','PreguntaController@index')->name('index.buscar');
// Buscador usuarios
Route::post('buscarUsuarios','UserController@index')->name('users.buscar');

// Perfil de usuario
Route::post('/user/{id}', 'UserController@update')->name('pregunta.actualizar');

// coger el favorito, añadir y borrar
Route::get('/getFavorito/{idUsuario}/{idPregunta}', 'UserController@getFavorito')->name('user.getFavorito');
Route::get('/setFavorito/{idUsuario}/{idPregunta}', 'UserController@setFavorito')->name('user.setFavorito');
Route::get('/unsetFavorito/{idUsuario}/{idPregunta}', 'UserController@unsetFavorito')->name('user.unsetFavorito');
