<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	if (Auth::check()) {
		return Redirect::intended('hello')->with('username', Auth::user()->username);
	} else {
		return View::make('login');
	}
});

Route::get('/hello', function()
{
	return View::make('hello');
});

Route::get('/hash/{pass}', function($pass)
{
	return Hash::make($pass);
});

Route::resource('users', 'UserController');

Route::resource('login', 'UserController@login');

Route::resource('logout', 'UserController@logout');