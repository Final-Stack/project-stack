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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Rutas de inicio de sesion con google
 */
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/create', 'PreguntaController@create')->name('pregunta.create');

Route::post('/', 'PreguntaController@store')->name('pregunta.store');

