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

// Route::resource('users', 'UserController');

// Route::resource('login', 'UserController@login');

// Route::get('login', array('as'=>'login', 'uses'=>'UserController@login'));
Route::post('login', array('as'=>'login', 'uses'=>'UserController@login'));
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@logout'));

Route::group(array('before' => 'auth'), function(){
	Route::get('reservations', array('as'=>'reservations', 'uses'=>'ReservationsController@index'));

	Route::get('destinations', array('as'=>'destinations', 'uses'=>'DestinationsController@index'));

	Route::get('passangers', array('as'=>'passangers', 'uses'=>'PassangersController@index'));
	Route::post('storePassanger', array('as'=>'storePassanger', 'uses'=>'PassangersController@store'));

	Route::get('arangements', array('as'=>'arangements', 'uses'=>'TravelDealController@index'));

	Route::get('payments', array('as'=>'payments', 'uses'=>'PaymentsController@index'));

	Route::get('reports', array('as'=>'reports', 'uses'=>'ReportsController@index'));

	Route::post('basicSearch', array('as' => 'basicSearch', 'uses' => 'DestinationsController@basicSearch'));

	Route::post('advancedSearch', array('as' => 'advancedSearch', 'uses' => 'DestinationsController@advancedSearch'));

	Route::get('basicSearch/{search_item}', array('as' => 'basicSearch', 'uses' => 'DestinationsController@Search'));

	Route::post('destinationEdit/{id}', array('as' => 'destinationEdit', 'uses' => 'DestinationsController@update'));

	Route::post('addDestination', array('as' => 'addDestination', 'uses' => 'DestinationsController@store'));

	Route::get('autocompleteDST', array('as' => 'autocompleteDST', 'uses' => 'DestinationsController@autosearch'));

	Route::get('accommodation', array('as' => 'accommodation', 'uses' => 'AccommodationController@index'));

	Route::get('organizators', array('as' => 'organizators', 'uses' => 'OrganizersController@index'));

	Route::get('autocompleteORG', array('as' => 'autocompleteORG', 'uses' => 'OrganizersController@autosearch'));

	Route::post('basicSearchOrg', array('as' => 'basicSearchOrg', 'uses' => 'OrganizersController@basicSearch'));

	Route::post('advancedSearchOrg', array('as' => 'advancedSearchOrg', 'uses' => 'OrganizersController@advancedSearch'));
	
	Route::post('organizatorEdit/{id}', array('as' => 'organizatorEdit', 'uses' => 'OrganizersController@update'));

	Route::post('organizatorEditAll/{id}', array('as' => 'organizatorEditAll', 'uses' => 'OrganizersController@updateAll'));

	Route::post('organizatorAdd', array('as' => 'organizatorAdd', 'uses' => 'OrganizersController@store'));

	Route::post('organizatorDelete/{id}', array('as' => 'organizatorDelete', 'uses' => 'OrganizersController@destroy'));

	
});


