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


Route::get('/', 'PreguntaController@index');


Route::get('/index', function () {
    return view('createQuestion');
});

Route::get('/create', 'PreguntaController@create')->name('pregunta.create');

Route::post('/', 'PreguntaController@store')->name('pregunta.store');

