<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', 'GameController@index');

Route::get('new', 'GameController@index');

Route::post('guess', 'GameController@guess');

Route::post('create', 'GameController@create');

Route::get('show', 'GameController@show');