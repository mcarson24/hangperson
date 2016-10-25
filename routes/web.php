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

Route::get('/', 'GameController@new');

Route::get('new', 'GameController@new');

Route::get('/', function (Request $request) {
	$value = $request->session()->get('key');

    return view('hello', compact('value'));
});

Route::get('hello', 'GameController@hello');
