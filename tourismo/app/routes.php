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
	return View::make('emails/reservation_request');
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

Route::get('resetPassword', array('as'=>'resetPassword', 'uses'=>'RemindersController@getRemind'));

Route::post('doPswReset', array('as'=>'doPswReset', 'uses'=>'RemindersController@postRemind'));

Route::get('password/reset/{token}', array('as'=>'password/reset', 'uses'=>'RemindersController@getReset'));

Route::post('password/doreset', array('as'=>'password/doreset', 'uses'=>'RemindersController@postReset'));

Route::group(array('before' => 'auth'), function(){
	Route::get('reservations', array('as'=>'reservations', 'uses'=>'ReservationsController@index'));
	
	Route::get('createReservation', array('as'=>'createReservation', 'uses'=>'ReservationsController@create'));

	Route::get('getTravelDeal/{id}', array('as'=>'getTravelDeal', 'uses'=>'ReservationsController@getTravelDeal'));

	Route::get('categoriesRes', array('as' => 'categoriesRes','uses' => 'ReservationsController@getCategories'));
	Route::get('destinationsRes', array('as' => 'destinationsRes','uses' => 'ReservationsController@getDestinations'));
	Route::get('organizersRes', array('as' => 'organizersRes','uses' => 'ReservationsController@getOrganizers'));
	Route::get('accomodationsRes', array('as' => 'accomodationsRes','uses' => 'ReservationsController@getAccomodations'));
	Route::get('initializeTD', array('as' => 'initializeTD','uses' => 'ReservationsController@initializeTD'));
	Route::get('initializePS', array('as' => 'initializePS','uses' => 'ReservationsController@initializePS'));
	Route::post('accommodationAddRes', array('as' => 'accommodationAddRes','uses' => 'ReservationsController@accomodationAddRes'));
	Route::post('createReservation', array('as' => 'createReservation','uses' => 'ReservationsController@store'));
	Route::get('paymentRsrvDetails', array('as' => 'paymentRsrvDetails', 'uses' => 'ReservationsController@detailsPayment'));
	Route::get('contract/{id}', array('as' => 'contract','uses' => 'ReservationsController@contract'));
	Route::post('reservation/delete', array('as' => 'reservation/delete', 'uses' => 'ReservationsController@destroy'));
	Route::get('autocompleteRES', array('as' => 'autocompleteRES', 'uses' => 'ReservationsController@autosearch'));
	Route::post('searchRes', array('as' => 'searchRes', 'uses' => 'ReservationsController@searchRes'));
	Route::get('reservation_request/{id}', array('as' => 'reservation_request','uses' => 'ReservationsController@reservation_request'));

	Route::get('editReservation/{id}', array('as' => 'editReservation', 'uses' => 'ReservationsController@show'));
	Route::post('updateReservation/{id}', array('as' => 'updateReservation', 'uses' => 'ReservationsController@update'));

	Route::get('destinations', array('as'=>'destinations', 'uses'=>'DestinationsController@index'));

	Route::get('passangers', array('as'=>'passangers', 'uses'=>'PassangersController@index'));
	Route::post('storePassanger', array('as'=>'storePassanger', 'uses'=>'PassangersController@store'));
	Route::get('deletePassanger/{id}', array('as'=>'deletePassanger/{id}', 'uses'=>'PassangersController@destroy'));
	Route::post('passangerEdit/{id}', array('as'=>'passangerEdit', 'uses'=>'PassangersController@update'));
	Route::get('autocompletePSG', array('as' => 'autocompletePSG', 'uses' => 'PassangersController@autosearch'));
	Route::post('basicPsgSearch', array('as' => 'basicPsgSearch', 'uses' => 'PassangersController@basicSearch'));
	Route::post('basicPsgForPeriodSearch', array('as' => 'basicPsgForPeriodSearch', 'uses' => 'PassangersController@basicPsgForPeriodSearch'));
	Route::get('passangerDetails', array('as' => 'passangerDetails', 'uses' => 'PassangersController@details'));
	Route::post('addPassanger', array('as' => 'addPassanger', 'uses' => 'PassangersController@addNew'));

	Route::get('traveldeals', array('as'=>'traveldeals', 'uses'=>'TravelDealController@index'));
	Route::post('storeTravelDeal', array('as'=>'storeTravelDeal', 'uses'=>'TravelDealController@store'));
	Route::get('deleteTravelDeal/{id}', array('as'=>'deleteTravelDeal/{id}', 'uses'=>'TravelDealController@destroy'));
	Route::get('autocompleteTrvlDlsCat', array('as' => 'autocompleteTrvlDlsCat', 'uses' => 'TravelDealController@autosearchCat'));
	Route::get('autocompleteTrvlDlsDst', array('as' => 'autocompleteTrvlDlsDst', 'uses' => 'TravelDealController@autosearchDst'));
	Route::post('basicTrvlDlsSearch', array('as' => 'basicTrvlDlsSearch', 'uses' => 'TravelDealController@basicSearch'));

	Route::post('addTravelDeal', array('as' => 'addTravelDeal', 'uses' => 'TravelDealController@addNew'));

	Route::get('travelDealDetails', array('as' => 'travelDealDetails', 'uses' => 'TravelDealController@details'));
	
	Route::get('payments', array('as'=>'payments', 'uses'=>'PaymentsController@index'));
	Route::get('paymentDetails', array('as' => 'paymentDetails', 'uses' => 'PaymentsController@details'));
	Route::get('autocompletePayment', array('as' => 'autocompletePayment', 'uses' => 'PaymentsController@autosearch'));
	Route::post('basicPaymentsSearch', array('as' => 'basicPaymentsSearch', 'uses' => 'PaymentsController@basicSearch'));
	Route::post('storePayment', array('as'=>'storePayment', 'uses'=>'PaymentsController@store'));
	Route::get('paymentSlip/{id}', array('as'=>'paymentSlip', 'uses'=>'PaymentsController@paymentSlip'));
	Route::get('payment/delete/{id}', array('as' => 'payment/delete', 'uses' => 'PaymentsController@destroy'));
	Route::post('storeExcursionPayment', array('as'=>'storeExcursionPayment', 'uses'=>'PaymentsController@storeExcursionPayment'));
	
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

	/////KATEGORIJE
	Route::post('newCategory', array('as' => 'newCategory', 'uses' => 'CategoriesController@store'));

	Route::get('debts', array('as' => 'debts', 'uses' => 'PassangersController@debts'));
	Route::post('debtsSearch', array('as' => 'debtsSearch', 'uses' => 'PassangersController@debtsSearch'));
	Route::get('dailyincome', function(){ return View::make('dailyincome'); });
	Route::get('incomeforperiod', array('as' => 'incomeforperiod', 'uses' => 'ReportsController@incomeforperiod'));
	Route::post('basicIncomesSearch', array('as' => 'basicIncomesSearch', 'uses' => 'ReportsController@basicIncomesSearch'));
	Route::get('passangersforperiod', array('as' => 'passangersforperiod', 'uses' => 'PassangersController@psgforperiod'));
	Route::get('excursions', array('as' => 'excursions', 'uses' => 'ReportsController@excursions'));
	Route::post('basicExcursionsSearch', array('as' => 'basicExcursionsSearch', 'uses' => 'ReportsController@basicExcursionsSearch'));
	Route::get('greenlist', array('as' => 'greenlist', 'uses' => 'PassangersController@psggreenlist'));
	Route::post('basicPsgGreenListSearch', array('as' => 'basicPsgGreenListSearch', 'uses' => 'PassangersController@basicPsgGreenListSearch'));
	Route::get('promoters', array('as' => 'promoters', 'uses' => 'ReportsController@promoters'));
	Route::post('basicPromotersSearch', array('as' => 'basicPromotersSearch', 'uses' => 'ReportsController@basicPromotersSearch'));
	
});

Route::filter('admin', function(){

   if ( ! Auth::user()->isAdmin())
   {
       return Redirect::to('/')
        ->withError('No Admin, sorry.');
   }

});

Route::group(array('before' => 'auth|admin'), function(){
	Route::get('users', array('as'=>'users', 'uses'=>'UserController@index'));
	Route::post('storeUser', array('as'=>'storeUser', 'uses'=>'UserController@store'));
	Route::get('deleteUser/{id}', array('as'=>'deleteUser/{id}', 'uses'=>'UserController@destroy'));
});