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

	public function InitializeTD()
	{
		return Response::json(array('data' => Travel_deals::get()->toArray()));
	}

	public function initializePS()
	{
		$psg =  Passanger::select(DB::raw('CONCAT (name," ",surname," JMBG: ",jmbg," Pasoš: ",passport) as passanger, id'))
		->get(array("passanger","id"))->toArray();
		
		return Response::json(array('data' => $psg));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return View::make('createReservationPartial');
		
	}

	public function getTravelDeal($id)
	{
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
		$acc = Input::get('acc','');

		$destinations = Destination::query();

		if( $acc != null ||$acc != '')
		{
				$destinations->join("accomodations","destinations.id","=","accomodations.destination_id")
								->where("accomodations.id","=", function($q) use ($acc){
									$q->from("accomodations")->join("accomodation_units","accomodations.id","=","accomodation_units.accommodations_id")
										->where("accomodation_units.id","=",$acc)->select("accomodations.id");
								});
		}
		
		$destinations->where(function($q) use ($query){
				$q->where('town','LIKE','%'.$query.'%')->orWhere('country','LIKE','%'.$query.'%');
			});

		return Response::json(array('data' => $destinations->get(array('town','country','destinations.id as id'))->toArray()));
	}

	public function getOrganizers()
	{
		$query = Input::get('q','');

		$organizers = Organizers::where('name','LIKE','%'.$query.'%')->get(array('name','pib'))->toArray();

		return Response::json(array('data' => $organizers));
	}

	public function getAccomodations()
	{
		$query = Input::get('q','');
		$dst = Input::get('dst','');

		$accomodations = Accomodations::query();

		if($dst != null || $dst != "")
		{
			$accomodations->join("destinations","accomodations.destination_id","=","destinations.id")
							->where("destinations.id","=",$dst);
		}

		$accomodations->join('accomodation_units','accomodations.id','=','accomodation_units.accommodations_id')
										->where(function($q) use ($query){
											$q->where('accomodations.name','LIKE','%'.$query.'%')->orWhere('accomodations.type','LIKE','%'.$query.'%')
										->orWhere('accomodation_units.name','LIKE','%'.$query.'%');
										})->select(DB::raw('CONCAT (accomodations.type,", ",accomodations.name,", ",accomodation_units.name,"/",accomodation_units.capacity) as name, accomodation_units.id'));
					

		return Response::json(array('data' => $accomodations->get(array('name', 'id'))->toArray()));
	}


//OVO TREBA PREBACITI U MODELE
	public function accomodationAddRes()
	{
		$type = Input::get("type");
		$name = Input::get("name");
		$dest = Input::get("destination_id");

		//units

		$units = $_POST["Unit"];
	

		$acc = new Accomodations;
		$acc->type = $type;
		$acc->name = $name;
		$acc->destination_id = $dest;

		$acc->Save();

		//return $units;

		if(is_array($units))
		{
			foreach ($units as $unit) {
				$newUnit = new Accomodation_units;
				$newUnit->name = $unit['name'];
				$newUnit->capacity = $unit['capacity'];
				$newUnit->number = $unit['number'];

				$newUnit->accommodations_id = $acc->id;

				$newUnit->Save();
			}
		}

		$accomodations = Accomodations::join('accomodation_units','accomodations.id','=','accomodation_units.accommodations_id')
										->where("accomodations.id","=", $acc->id)
										->select(DB::raw('CONCAT (accomodations.type,", ",accomodations.name,", ",accomodation_units.name,"/",accomodation_units.capacity) as name, accomodation_units.id'));
		return Response::json(array('data' => $accomodations->get(array('name', 'id'))->toArray()));

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