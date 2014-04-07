<?php

class ReservationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$reservations = Reservation::all();

		//dd($reservations->first()->traveldeal());
		return View::make('reservations')->nest('reservationsPartial','reservationsPartial', array('reservations' => $reservations));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$traveldeals = Travel_deals::join('categories','travel_deals.category_id','=','categories.id')
									->join('destinations','destinations.id','=','travel_deals.destination_id')
									->join('organizers','organizers.pib','=','travel_deals.organizer_id')
									->join('accomodation_units','accomodation_units.id','=','travel_deals.accomodation_unit_id')
									->select(DB::raw('CONCAT (categories.name,", ",organizers.name,", ",destinations.town," ",destinations.country,", ",transportation,", ", service,",",accomodation_units.name,"/",accomodation_units.capacity) as traveldeal, travel_deals.id as id'))
									->lists("traveldeal","id");
		$traveldeals = array("0" => "Izaberite aranžman") + $traveldeals;

		return View::make('createReservationPartial', array("traveldeals" => $traveldeals));
		
	}

	public function getTravelDeal($id)
	{
		/*$traveldeals = Travel_deals::join('categories','travel_deals.category_id','=','categories.id')
									->join('destinations','destinations.id','=','travel_deals.destination_id')
									->join('organizers','organizers.pib','=','travel_deals.organizer_id')
									->join('accomodation_units','accomodation_units.id','=','travel_deals.accomodation_unit_id')
									->where('travel_deals.id','=',$id)
									->select(DB::raw("categories.name as category","organizers.name as organizer", 'CONCAT ("destinations.town",",", "destinations.country") as destination', "transportation", "service", 'CONCAT ("accomodation_units.name","-",accomodation_units.capacity") as accomodation'))
									->get(array('category','organizer','destination','transportation','service','accomodation'));*/
		$traveldeals = Travel_deals::find($id)->getTravelDeal();
		//dd($traveldeals);

		return Response::json(array('data' => $traveldeals));
	}

	public function getCategories()
	{
		$query = Input::get('q','');

		$categories = Categories::where('name','LIKE','%'.$query.'%')->get(array('name','id'))->toArray();

		return Response::json(array('data' => $categories));
	}

	public function getDestinations()
	{
		$query = Input::get('q','');

		$destinations = Destination::where('town','LIKE','%'.$query.'%')->orWhere('country','LIKE','%'.$query.'%')->get(array('town','country','id'))->toArray();

		//dd($destinations);
		return Response::json(array('data' => $destinations));
	}

	public function getOrganizers()
	{
		$query = Input::get('q','');

		$organizers = organizers::where('name','LIKE','%'.$query.'%')->get(array('name','id'))->toArray();

		return Response::json(array('data' => $organizers));
	}

	public function getAccomodations()
	{
		$query = Input::get('q','');

		$accomodations = Accomodations::join('accomodation_units','accomodations.id','=','accomodation_units.accommodations_id')
										->where('accomodations.name','LIKE','%'.$query.'%')->orWhere('accomodations.type','LIKE','%'.$query.'%')
										->orWhere('accomodation_units.name','LIKE','%'.$query.'%')
										->select(DB::raw('CONCAT (accomodations.type,", ",accomodations.name,", ",accomodation_units.name,"/",accomodation_units.capacity) as name, accomodation_units.id'))
										->get(array('name', 'id'))
										->toArray();
		return Response::json(array('data' => $accomodations));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}