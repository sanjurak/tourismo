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
		return Redirect::intended('homepage')->with('username', Auth::user()->username);
	} else {
		return View::make('login');
	}
});

Route::get('/hello', function()
{
	return View::make('hello');
});

Route::get('/homepage', function()
{
	return View::make('homepage');
});

Route::get('/hash/{pass}', function($pass)
{
	return Hash::make($pass);
});

Route::resource('users', 'UserController');

Route::resource('login', 'UserController@login');

Route::get('logout', array( 'as' => 'logout', 'uses' => 'UserController@logout'));

Route::get('reservations', array('as'=>'reservations', 'uses'=>'ReservationsController@index'));

