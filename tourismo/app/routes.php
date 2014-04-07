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
	Route::get('passangerDetails', array('as' => 'passangerDetails', 'uses' => 'PassangersController@details'));

	Route::get('traveldeals', array('as'=>'traveldeals', 'uses'=>'TravelDealController@index'));
	Route::post('storeTravelDeal', array('as'=>'storeTravelDeal', 'uses'=>'TravelDealController@store'));
	Route::get('deleteTravelDeal/{id}', array('as'=>'deleteTravelDeal/{id}', 'uses'=>'TravelDealController@destroy'));
	Route::get('autocompleteTrvlDlsCat', array('as' => 'autocompleteTrvlDlsCat', 'uses' => 'TravelDealController@autosearchCat'));
	Route::get('autocompleteTrvlDlsDst', array('as' => 'autocompleteTrvlDlsDst', 'uses' => 'TravelDealController@autosearchDst'));
	Route::post('basicTrvlDlsSearch', array('as' => 'basicTrvlDlsSearch', 'uses' => 'TravelDealController@basicSearch'));
	Route::get('travelDealDetails', array('as' => 'travelDealDetails', 'uses' => 'TravelDealController@details'));
	
	Route::get('payments', array('as'=>'payments', 'uses'=>'PaymentsController@index'));

	Route::get('reports', array('as'=>'reports', 'uses'=>'ReportsController@index'));

	Route::post('basicSearch', array('as' => 'basicSearch', 'uses' => 'DestinationsController@basicSearch'));

	Route::post('advancedSearch', array('as' => 'advancedSearch', 'uses' => 'DestinationsController@advancedSearch'));

	Route::get('basicDstSearch/{search_item}', array('as' => 'basicSearch', 'uses' => 'DestinationsController@Search'));

	Route::post('destinationEdit/{id}', array('as' => 'destinationEdit', 'uses' => 'DestinationsController@update'));

	Route::post('addDestination', array('as' => 'addDestination', 'uses' => 'DestinationsController@store'));

	Route::get('autocompleteDST', array('as' => 'autocompleteDST', 'uses' => 'DestinationsController@autosearch'));

	Route::get('accommodation', array('as' => 'accommodation', 'uses' => 'AccommodationsController@index'));
	
	Route::post('accommodationEdit/{id}', array('as' => 'accommodationEdit', 'uses' => 'AccommodationsController@update'));
	
	Route::post('unitsEdit/{id}', array('as' => 'unitsEdit', 'uses' => 'AccommodationsController@edit'));

	Route::post('unitsEditSave', array('as' => 'unitsEditSave', 'uses' => 'AccommodationUnitsController@updateArray'));

	Route::post('addUnits/{accId}', array('as' => 'addUnit', 'uses' => 'AccommodationUnitsController@storeArray'));
	
	Route::post('accommodationDelete/{id}', array('as' => 'accommodationDelete', 'uses' => 'AccommodationsController@destroy'));

	Route::get('accommodationDstList', array('as' => 'accommodationDstList', 'uses' => 'AccommodationsController@dstList'));
	
	Route::post('accommodationAdd', array('as' => 'accommodationAdd', 'uses' => 'AccommodationsController@store'));

	Route::get('autocompleteACC', array('as' => 'autocompleteACC', 'uses' => 'AccommodationsController@autocompleteSearch'));

	Route::get('typeListAcc', array('as' => 'typeListAcc', 'uses' => 'AccommodationsController@typeList'));
	
	Route::post('basicSearchAcc', array('as' => 'basicSearchAcc', 'uses' => 'AccommodationsController@basicSearch'));

	Route::get('typeUnitsListAcc', array('as' => 'typeUnitsListAcc', 'uses' => 'AccommodationUnitsController@typeUnitsList'));

	Route::get('organizators', array('as' => 'organizators', 'uses' => 'OrganizersController@index'));

	Route::get('autocompleteORG', array('as' => 'autocompleteORG', 'uses' => 'OrganizersController@autosearch'));

	Route::post('basicSearchOrg', array('as' => 'basicSearchOrg', 'uses' => 'OrganizersController@basicSearch'));

	Route::post('advancedSearchOrg', array('as' => 'advancedSearchOrg', 'uses' => 'OrganizersController@advancedSearch'));
	
	Route::post('organizatorEdit/{id}', array('as' => 'organizatorEdit', 'uses' => 'OrganizersController@update'));

	Route::post('organizatorEditAll/{id}', array('as' => 'organizatorEditAll', 'uses' => 'OrganizersController@updateAll'));

	Route::post('organizatorAdd', array('as' => 'organizatorAdd', 'uses' => 'OrganizersController@store'));

	Route::post('organizatorDelete/{id}', array('as' => 'organizatorDelete', 'uses' => 'OrganizersController@destroy'));

	
});


