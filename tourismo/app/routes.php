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

Route::get('/', array('as'=>'loginpage', function()
{
	if (Auth::check()) {
		return Redirect::intended('homepage')->with('username', Auth::user()->username);
	} else {
		return View::make('login');
	}
}));

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

// Route::resource('users', 'UserController');

// Route::resource('login', 'UserController@login');

// Route::get('login', array('as'=>'login', 'uses'=>'UserController@login'));
Route::post('loginpost', array('as'=>'loginpost', 'uses'=>'UserController@login'));
Route::any('login', array('as'=>'login', function()
	{
		return Redirect::route('loginpage');
	}));

Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@logout'));

Route::group(array('before' => 'auth'), function(){
	Route::get('reservations', array('as'=>'reservations', 'uses'=>'ReservationsController@index'));

	Route::get('destinations', array('as'=>'destinations', 'uses'=>'DestinationsController@index'));

	Route::get('passangers', array('as'=>'passangers', 'uses'=>'PassangersController@index'));
	Route::post('storePassanger', array('as'=>'storePassanger', 'uses'=>'PassangersController@store'));
	Route::get('deletePassanger/{id}', array('as'=>'deletePassanger/{id}', 'uses'=>'PassangersController@destroy'));
	Route::post('passangerEdit/{id}', array('as'=>'passangerEdit', 'uses'=>'PassangersController@update'));
	Route::get('autocompletePSG', array('as' => 'autocompletePSG', 'uses' => 'PassangersController@autosearch'));
	Route::post('basicPsgSearch', array('as' => 'basicPsgSearch', 'uses' => 'PassangersController@basicSearch'));
	Route::get('basicPsgSearch/{search_item}', array('as' => 'basicPsgSearch', 'uses' => 'PassangersController@Search'));
	Route::get('passangerDetails', array('as' => 'passangerDetails', 'uses' => 'PassangersController@details'));

	Route::get('arangements', array('as'=>'arangements', 'uses'=>'TravelDealController@index'));

	Route::get('payments', array('as'=>'payments', 'uses'=>'PaymentsController@index'));

	Route::get('reports', array('as'=>'reports', 'uses'=>'ReportsController@index'));

	Route::post('basicDstSearch', array('as' => 'basicSearch', 'uses' => 'DestinationsController@basicSearch'));

	Route::post('advancedSearch', array('as' => 'advancedSearch', 'uses' => 'DestinationsController@advancedSearch'));

	Route::get('basicDstSearch/{search_item}', array('as' => 'basicSearch', 'uses' => 'DestinationsController@Search'));

	Route::post('destinationEdit/{id}', array('as' => 'destinationEdit', 'uses' => 'DestinationsController@update'));

	Route::post('addDestination', array('as' => 'addDestination', 'uses' => 'DestinationsController@store'));

	Route::get('autocompleteDST', array('as' => 'autocompleteDST', 'uses' => 'DestinationsController@autosearch'));

	Route::get('accommodation', array('as' => 'accommodation', 'uses' => 'AccommodationController@index'));
});


