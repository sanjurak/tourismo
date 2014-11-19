<?php

class ReservationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$reservations = Reservation::orderBy('travel_date', 'DESC')->paginate(20);

		//dd($reservations->first()->traveldeal());
		return View::make('reservations')->nest('reservationsPartial','reservationsPartial', array('reservations' => $reservations));
	}
	
	public function appendValue($data, $type, $element)
	{
	  // operate on the item passed by reference, adding the element and type
	  foreach ($data as $key => & $item) {
	    $item[$element] = $type;
	  }
	  return $data;   
	}

	public function InitializeTD()
	{
		return Response::json(array('data' => Travel_deals::get()->toArray()));
	}

	public function initializePS()
	{
		$psg =  Passanger::select(DB::raw('CONCAT (name," ",surname," JMBG: ",jmbg," Pasoš: ",passport) as passanger, id'))
		->orderBy('id','desc')->get(array("passanger","id"))->toArray();
		
		return Response::json(array('data' => $psg));
	}
	
	public function autosearch()
	{
		$query = Input::get('q','');

		 //if(!$query && $query == '') return Response::json(array(), 400);

		$passangers = Passangers::join("passanger","passangers.passanger_id","=","passanger.id")
								->join("reservations","passangers.reservation_id","=","reservations.id")
								->select(DB::raw('CONCAT(name, " ", surname,", ", jmbg) as term'),"passanger.id as id")
								->where("passanger.name","LIKE","%".$query."%")
								->orWhere("passanger.surname","LIKE","%".$query."%")
								->orWhere("passanger.jmbg","LIKE","%".$query."%")
								->get(array("term","id"))
								->toArray();

		 $reservations = Reservation::where("reservation_number","LIKE","%".$query."%")
		 					->get(array("reservation_number as term","reservation_number as id"))
		 					->toArray();

		 $passangers = $this->appendValue($passangers,'passanger','class');
		 $reservations = $this->appendValue($reservations,'resnum','class');

		 $data = array_merge($passangers, $reservations);

		 return Response::json(array('data' => $data));
	}
	
	public function searchRes()
	{
		$searchTerm = Input::get('search_item','');
		$reservations = null;
		if($searchTerm == "*")
			$reservations = Reservation::orderBy('id', 'DESC')->paginate(20);
		else
			$reservations = Reservation::join("passangers","passangers.reservation_id","=","reservations.id")
							->where('reservation_number','=',$searchTerm)
							->orWhere('reservations.passanger_id','=',$searchTerm)
							->orWhere('passangers.passanger_id','=',$searchTerm)
							->orderBy('reservations.travel_date', 'DESC')->paginate(20);
		

		return View::make('reservationsPartial',array('reservations' => $reservations));
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
		DB::beginTransaction();

		try
		{		
			$startdate = date('Y-m-d', strtotime(Input::get("start_date")));
			$enddate = date('Y-m-d', strtotime(Input::get("end_date")));
			$traveldate = date('Y-m-d', strtotime(Input::get("travel_date")));
			$numnights = Input::get("numnights");
			$discount = Input::get("discount");
			$discounter = Input::get("discounter");
			$clockindex = Input::get("clockindex");
			$totalDin = Input::get("TotalDIN");
			$totalEur = Input::get("TotalEUR");
			$notes = Input::get("notes");
			$internalnotes = Input::get("internalnotes");
			$internal = Input::get("Internal");
			
			$resNum = Input::get("ResNum");

			$traveldealId = Input::get("traveldealId");

			$items = $_POST["Item"];
			$passangers = $_POST["Passangers"];
			$passangersPrices = $_POST["PsgItem"];

			
			$res_num = "";

			if($resNum != null && $resNum != "")
			{
				$res_num = $resNum;
			}
			else
			{
				$resnum = Reservation_number::first();
				if($internal == "true")
				{
					$res_num = $resnum->number ."-" . $resnum->internalNum . "/" . $resnum->year;
					$resnum->internalNum = $resnum->internalNum + 1;
					$internal = 1;
				}
				else
				{
					$res_num = $resnum->number . "/" . $resnum->year;
					$resnum->number = $resnum->number + 1;
					$resnum->internalNum = 1;
					$internal = 0;
				}
				$resnum->Save();
			}

			$reservation = new Reservation;
			$reservation->reservation_number = $res_num;
			$reservation->travel_deal_id = $traveldealId;
			$reservation->start_date = $startdate;
			$reservation->end_date = $enddate;
			$reservation->travel_date = $traveldate;
			$reservation->nights_num = $numnights;
			$reservation->passanger_id = $passangers[0];
			$reservation->status = "Aktivna";
			$reservation->discount = $discount;
			$reservation->discounter_name = $discounter;
			$reservation->clock_index = $clockindex;
			$reservation->price_total_din = $totalDin;
			$reservation->price_total_eur = $totalEur;
			$reservation->note = $notes;
			$reservation->note_internal = $internalnotes;
			
			if(Auth::user())
			$reservation->user = Auth::user()->name . " " . Auth::user()->surname;
			$reservation->internal = $internal;

			$reservation->Save();	


			$traveldeal = Travel_deals::find($traveldealId);

			$excursionIds = array();

			if($traveldeal != null)
			{
				if(is_array($items))
				{
					foreach ($items as $item) {
						
						if($item['isExcursion'] == "true")
						{
							$excursion = new Excursion;
							$excursion->excursionItem = $item['name'];
							$excursion->priceDin = $item['din'];
							$excursion->priceEur = $item['euro'];
							$excursion->Save();

							$excursionIds[$excursion->excursionItem] = $excursion->id;

							$resExc = new Reservation_excursion;
							$resExc->destinationId = $traveldeal->destination_id;
							$resExc->excursionId = $excursion->id;
							$resExc->reservationId = $reservation->id;
							$resExc->num = $item['num'];
							$resExc->Save();
						}
						else
						{
							$resprice = new Reservation_price;
							$resprice->priceItem = $item['name'];
							$resprice->priceDin = $item['din'];
							$resprice->priceEur = $item['euro'];	
							$resprice->num = $item['num'];					
							$resprice->reservationId = $reservation->id;
							$resprice->Save();
						};
					}
				}

			$totalDin = 0;
			$totalEur = 0;
			foreach(Reservation_price::where("reservationId","=",$reservation->id)->get() as $resPrice)
			{
				if(preg_match("/popust/i",$resPrice->priceItem))
				{
					$totalDin -= $resPrice->priceDin * $resPrice->num;
					$totalEur -= $resPrice->priceEur * $resPrice->num;
				}
				else
				{
					$totalDin += $resPrice->priceDin  * $resPrice->num;
					$totalEur += $resPrice->priceEur  * $resPrice->num;
				}
			}

			$reservation->price_total_din = $totalDin;
			$reservation->price_total_eur = $totalEur;
			$reservation->save();

				if(is_array($passangersPrices))
				{
					foreach ($passangersPrices as $psgPrices) {
						
						if(is_array($psgPrices))
						{
							foreach ($psgPrices as $psgPrice) {
								if($psgPrice['isExcursion'] == "true")
								{
									$resExc = new PassangerExcursion;
									$resExc->passangerId = $psgPrice["psgID"];
									$resExc->excursion_id = $excursionIds[$psgPrice["name"]];
									$resExc->reservationId = $reservation->id;
									$resExc->num = $psgPrice['num'];
									$resExc->Save();
								}
								else
								{
									$psgResPrice = new PassangerPrice;
									$psgResPrice->price_item = $psgPrice["name"];
									$psgResPrice->price_din = $psgPrice["din"];
									$psgResPrice->price_eur = $psgPrice["euro"];
									$psgResPrice->num = $psgPrice["num"];
									$psgResPrice->reservation_id = $reservation->id;
									$psgResPrice->passanger_id = $psgPrice["psgID"];
									$psgResPrice->save();
								}
							}
						}
					}
				}

				if(is_array($passangers))
				{
					foreach ($passangers as $passanger) {
						$psg = new Passangers;
						$psg->passanger_id = $passanger;
						$psg->reservation_id = $reservation->id;
						$psg->Save();
					}
				}
			}
		}
		catch(\Exception $e)
		{
			DB::rollback();
			return Response::json(array('status' => "failure",'message' => $e->getMessage()));
		}

		DB::commit();
		return Response::json(array('status' => "success", 'id' => $reservation->id));
	}

	public function contract($id)
	{
		$reservation = Reservation::find($id);
		$passangers = Passanger::join("passangers","passanger.id","=","passangers.passanger_id")
								->where("reservation_id","=",$reservation->id)
								->select("passanger.name", "passanger.surname", "passanger.tel", "passanger.mob", "passanger.passport", "passanger.birth_date")
								->get();
		$pdf = null;
		try{
			$pdf = PDF::loadView('reports//reservation_contract', array('reservation' => $reservation, 'passangers' => $passangers),array(),'UTF-8')->stream('CONTRACT.pdf');
		}
		catch(\Exception $e)
		{
			return Response::json(array('status' => "failure", 'message' => $e->getMessage()));
		}
		
		return $pdf;
	}

	public function reservation_request($id)
	{
		$reservation = Reservation::find($id);
		$passangers_query = Passanger::join("passangers","passanger.id","=","passangers.passanger_id")
								->where("reservation_id","=",$reservation->id)
								->select("passanger.name", "passanger.surname", "passanger.tel", "passanger.mob", "passanger.passport", "passanger.birth_date");
		$passangers = $passangers_query->get();
		$passangers_count = $passangers_query->count();
		$trvl_dl = Travel_deals::find($reservation->travel_deal_id);
		$organizer = Organizers::find($trvl_dl->organizer_id);
		$destination = Destination::find($trvl_dl->destination_id);
		$accomodation_unit = Accomodation_units::find($trvl_dl->accomodation_unit_id);
		$accomodation = Accomodations::find($accomodation_unit->accommodations_id);

//		$sent = Mail::send('emails//reservation_request', array('reservation' => $reservation, 'passangers' => $passangers, 'organizer' => $organizer, 'travel_deal' => $trvl_dl, 'destination' => $destination, 'accomodation_unit' => $accomodation_unit, 'accomodation' => $accomodation, 'passangers_count' => $passangers_count), function($message) use ($organizer)
//		{
//		    $message->to($organizer->email, $organizer->name)->subject('Zahtev za rezervacijom');
//		});
//
//		if ($sent == 1) {
			$pdf = null;
			try{
				$pdf = PDF::loadView('emails//reservation_request', array('reservation' => $reservation, 'passangers' => $passangers, 'organizer' => $organizer, 'travel_deal' => $trvl_dl, 'destination' => $destination, 'accomodation_unit' => $accomodation_unit, 'accomodation' => $accomodation, 'passangers_count' => $passangers_count),array(),'UTF-8')->stream('REQUEST.pdf');
			}
			catch(\Exception $e)
			{
				return Response::json(array('status' => "failure", 'message' => $e->getMessage()));
			}
			return $pdf;
//		}
//		return "Mail not sent...";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$reservation = Reservation::find($id);
		$traveldeal = Travel_deals::find($reservation->travel_deal_id);
		$passangers = Passanger::join("passangers","passangers.passanger_id","=","passanger.id")
					->where("passangers.reservation_id","=",$reservation->id)
					->get();
		//dd($passangers->toArray());
		$accunit = $traveldeal->accomodationUnit;
		
		$resPrices = Reservation_price::where("reservationId", "=", $id)->get();
		$psgPrices = array();
		$excursions = array();
		$names = array();
		$psgIds = PassangerPrice::join("passanger","passanger.id","=","passanger_prices.passanger_id")
			->where("reservation_id", "=", $id)->select(array("passanger_id", "name", "surname"))->distinct("passanger_id")->get();
		
		foreach($psgIds as $ID)
		{
			$psgPrices[$ID->passanger_id] = PassangerPrice::where("reservation_id", "=", $id)
												->where("passanger_id","=",$ID->passanger_id)->get();
			$names[$ID->passanger_id] = $ID->name . " " . $ID->surname;
			$excursions[$ID->passanger_id] = Excursion::join("passanger_excursions","excursion.id","=","passanger_excursions.excursion_id")
												->where("passangerId","=",$ID->passanger_id)
												->where("reservationId", "=", $id)
												->get(array("excursion.id as excursionId","priceDin","priceEur","excursionItem","num","passangerId","reservationId","passanger_excursions.id as peId"));
		}

		$resExcursions = Reservation_excursion::join("excursion","excursion.id","=","reservation_excursion.excursionId")
							->where("reservationId","=",$id)
							->get(array("excursion.id as excursionId","priceDin","priceEur","excursionItem","num","reservationId","reservation_excursion.id as peId"));

		return View::make("editReservationPartial",array('reservation' => $reservation, 
					'traveldeal' => $traveldeal, 'passangers' => $passangers, 
					'accunit' => $accunit, 'resPrices' => $resPrices, 'names' => $names,
					'psgPrices' => $psgPrices,'resExcursions' => $resExcursions, 'excursions' => $excursions));
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
		DB::beginTransaction();

		try
		{
			$passangers = isset($_POST["Passangers"])?$_POST["Passangers"]:null;
			$oldpassangers = $_POST["OldPassangers"];
						
			$reservation = Reservation::find($id);
			
			$reservation->reservation_number = Input::get("reservation_number");
			$reservation->start_date = date('Y-m-d', strtotime(Input::get("start_date")));			
			$reservation->end_date= date('Y-m-d', strtotime(Input::get("end_date")));			
			$reservation->travel_date = date('Y-m-d', strtotime(Input::get("travel_date")));			
			$reservation->nights_num = Input::get("nights_num");			
			$reservation->discount= Input::get("discount");
			$reservation->discounter_name= Input::get("discounter_name");
			$reservation->clock_index= Input::get("clock_index");
			$reservation->note= Input::get("note");			
			$reservation->note_internal= Input::get("note_internal");			
			$reservation->travel_deal_id = Input::get("traveldeal_id");
			
			$reservation->save();
			
			if($passangers != null && is_array($passangers))
			{
				foreach ($passangers as $passanger) {
					$psg = new Passangers;
					$psg->passanger_id = $passanger;
					$psg->reservation_id = $id;
					$psg->Save();
				}
			}
			
			$flag = false;
			$newid = 0;
			
			if($oldpassangers != null && is_array($oldpassangers))
			{
				foreach ($oldpassangers as $oldpassanger) {
					
					if($oldpassanger['delete'] == 1)
					{
						Passangers::destroy($oldpassanger['id']);
						if($reservation->passanger_id == $oldpassanger['id'])
							$flag = true;
						
					}
					else
					{
						//dd(Passangers::find($oldpassanger['id']));
						 $newid = Passangers::find($oldpassanger['id'])->passanger_id;

					}
				}
			}
			
			if($flag)
			{
				if($newid != 0)
					$reservation->passanger_id = $newid;
				else
					$reservation->passanger_id = $passangers[0];
				
				$reservation->save();
					
			}
				
			$oldprices = isset($_POST["Prices"])?$_POST["Prices"] : null;
			
			if($oldprices && is_array($oldprices))
			{
				foreach($oldprices as $price)
				{
					$idp = $price['id'];
					
					if($price['delete'] == 1)
					{
						Reservation_price::destroy($idp);
					}
					else
					{
						$resprice = Reservation_price::find($idp);
						$resprice->priceItem = $price['name'];
						$resprice->priceDin = $price['priceDin'];
						$resprice->priceEur = $price['priceEur'];
						$resprice->num = $price['num'];
						$resprice->save();
					}
				}
			}

			$oldexcursions = isset($_POST["ExcursionPrices"]) ? $_POST["ExcursionPrices"] : null;
			if($oldexcursions != null && is_array($oldexcursions))
			{
				foreach($oldexcursions as $excursion)
				{
					$reId = $excursion["id"];

					if($excursion["delete"] == 1)
					{
						Reservation_excursion::destroy($reId);
					}
					else
					{
						$resExc = Reservation_excursion::find($reId);
						$resExc->num = $excursion["num"];
						$resExc->Save();
						$exc = Excursion::find($resExc->excursionId);
						$exc->priceDin = $excursion["priceDin"];
						$exc->priceEur = $excursion["priceEur"];
						$exc->excursionItem = $excursion["name"];
						$exc->Save();
					}
				}
			}
			
			$prices = isset($_POST['ItemNew'])?$_POST['ItemNew'] : null;
			$excursionIds = array();
			$traveldeal = Travel_deals::find($_POST["traveldeal_id"]);

			if($prices != null && is_array($prices))
			{
				foreach($prices as $item)
				{
					if($item['isExcursion'] == "true")
					{

						$excursion = new Excursion;
						$excursion->excursionItem = $item['name'];
						$excursion->priceDin = $item['din'];
						$excursion->priceEur = $item['euro'];
						$excursion->Save();

						$excursionIds[$excursion->excursionItem] = $excursion->id;

						$resExc = new Reservation_excursion;
						$resExc->destinationId = $traveldeal->destination_id;
						$resExc->excursionId = $excursion->id;
						$resExc->reservationId = $reservation->id;
						$resExc->num = $item['num'];
						$resExc->Save();
					}
					else
					{
						$resprice = new Reservation_price;
						$resprice->priceItem = $item['name'];
						$resprice->priceDin = $item['din'];
						$resprice->priceEur = $item['euro'];	
						$resprice->num = $item['num'];					
						$resprice->reservationId = $reservation->id;
						$resprice->Save();
					}
				}
			}

			$totalDin = 0;
			$totalEur = 0;
			foreach(Reservation_price::where("reservationId","=",$reservation->id)->get() as $resPrice)
			{
				if(preg_match("/popust/i",$resPrice->priceItem))
				{
					$totalDin -= $resPrice->priceDin * $resPrice->num;
					$totalEur -= $resPrice->priceEur * $resPrice->num;
				}
				else
				{
					$totalDin += $resPrice->priceDin  * $resPrice->num;
					$totalEur += $resPrice->priceEur  * $resPrice->num;
				}
			}

			$reservation->price_total_din = $totalDin;
			$reservation->price_total_eur = $totalEur;
			$reservation->save();

			$psgItems = isset($_POST["PsgItem"]) ? $_POST["PsgItem"] : null;

			if($psgItems != null && is_array($psgItems))
			{
				foreach ($psgItems as $psgPrices) {
						
						if(is_array($psgPrices))
						{
							foreach ($psgPrices as $psgPrice) {
								if($psgPrice['delete'] == 1)
								{
									PassangerPrice::destroy($psgPrice["id"]);
								}
								else
								{
									$psgResPrice = PassangerPrice::find($psgPrice["id"]);
									$psgResPrice->price_item = $psgPrice["name"];
									$psgResPrice->price_din = $psgPrice["priceDin"];
									$psgResPrice->price_eur = $psgPrice["priceEur"];
									$psgResPrice->num = $psgPrice["num"];
									$psgResPrice->reservation_id = $reservation->id;
									$psgResPrice->passanger_id = $psgPrice["psgid"];
									$psgResPrice->save();
								}
							}
						}
					}
			}

			$psgExcursions = isset($_POST["Excursion"])?$_POST["Excursion"]:null;

			if($psgExcursions != null && is_array($psgExcursions))
			{
				foreach ($psgExcursions as $psgExc) {
						
						if(is_array($psgExc))
						{
							foreach ($psgExc as $psge) {
								if($psge['delete'] == 1)
								{
									PassangerExcursion::destroy($psge["id"]);
								}
								else
								{
									$psgResExc = PassangerExcursion::find($psge["id"]);
									//dd($psgResExc);
									$psgResExc->num = $psge["num"];
									$exc = Excursion::find($psgResExc->excursion_id);
									$exc->excursionItem = $psge["name"];
									$exc->priceDin = $psge["priceDin"];
									$exc->priceEur = $psge["priceEur"];
									$psgResExc->save();
									$exc->Save();
								}
							}
						}
					}
			}

			$psgNewItems = isset($_POST["PsgItemNew"]) ? $_POST["PsgItemNew"] : null;

			if($psgNewItems != null && is_array($psgNewItems))
			{
				foreach ($psgNewItems as $psgPrices) {
						
						if(is_array($psgPrices))
						{
							foreach ($psgPrices as $psgPrice) {
								if($psgPrice['isExcursion'] == "true")
								{
									$resExc = new PassangerExcursion;
									$resExc->passangerId = $psgPrice["psgID"];
									$resExc->excursion_id = $excursionIds[$psgPrice["name"]];
									$resExc->reservationId = $reservation->id;
									$resExc->num = $psgPrice['num'];
									$resExc->Save();
								}
								else
								{
									$psgResPrice = new PassangerPrice;
									$psgResPrice->price_item = $psgPrice["name"];
									$psgResPrice->price_din = $psgPrice["din"];
									$psgResPrice->price_eur = $psgPrice["euro"];
									$psgResPrice->num = $psgPrice["num"];
									$psgResPrice->reservation_id = $reservation->id;
									$psgResPrice->passanger_id = $psgPrice["psgID"];
									$psgResPrice->save();
								}
							}
						}
					}
			}
							
			$log = new ReservationsLog;
			
			$log->reservation_id = $id;
			$log->user_id = Auth::user()->username;
			$log->save();
		}
		catch(\Exception $e)
		{
			DB::rollback();
			return Response::json(array('status' => "failure",'message' => $e->getMessage()));
		}

		DB::commit();
		return Response::json(array('status' => "success", 'id' => $reservation->id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		DB::beginTransaction();
		
		try{		
			$affectedrows = Reservation_price::where("reservationId","=",$id)->delete();
			$excursionrows = Reservation_excursion::where("reservationId","=",$id)->delete();
			$psgrows = Passangers::where("reservation_id","=",$id)->delete();
			$resLog = ReservationsLog::where("reservation_id", "=", $id)->delete();
			
			Reservation::destroy($id);
		}
		catch(\Excception $e)
		{
			DB::rollback();
			return Response::json(array('status' => "failure", 'message' => $e->getMessage()));
		}
		DB::commit();
		Session::flash('success',  "Uspešno brisanje rezervacije");
		return Redirect::back();
	}

	/**
	 * Details for populating new paymenr modal view
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function detailsPayment()
	{
		$reservation = Reservation::find(Input::get("rsrv_id"));
		$prd = new PaymentResDetails();
		$prd->reservation_number = $reservation->reservation_number;
		$prd->reservation_id = $reservation->id;
		$passangers = Passangers::where('reservation_id','=',$reservation->id)->get();
		foreach ($passangers as $passanger) {
			$psg = Passanger::find($passanger->passanger_id);
			$psg_data = array($psg->id, $psg->name.' '.$psg->surname.' JMBG: '.$psg->jmbg);
			array_push($prd->passanger_names, $psg_data);

			$psgExcCount = PassangerExcursion::where('passangerId','=',$passanger->passanger_id)
									->where('reservationId','=',$reservation->id)->count();
			if ($psgExcCount >= 1)
				array_push($prd->passanger_names_i, $psg_data);

			$pltp = new PsgLeftToPay();
			$psgPrices = PassangerPrice::where('reservation_id','=',$reservation->id)->
											where('passanger_id','=',$psg->id)->get();
			foreach ($psgPrices as $psgPrice) {
				if (preg_match('/\bpopust\b/i', $psgPrice->price_item) == 1) {
					$pltp->left_to_pay_din -= ($psgPrice->price_din*$psgPrice->num);
					$pltp->left_to_pay_eur -= ($psgPrice->price_eur*$psgPrice->num);
				} else {
					$pltp->left_to_pay_din += ($psgPrice->price_din*$psgPrice->num);
					$pltp->left_to_pay_eur += ($psgPrice->price_eur*$psgPrice->num);
				}
			}
			$payments = Payment::where('reservation_id','=',$reservation->id)->
									where('passanger_id','=',$psg->id)->
									where('status','=',1)->get();
			foreach ($payments as $payment) {
				$pltp->left_to_pay_din -= $payment->amount_din;
				$pltp->left_to_pay_eur -= round($payment->amount_eur_din/$payment->exchange_rate, 2);
			}
			$prd->passanger_left_to_pay[$psg->id] = $pltp;

			$pltpi = new PsgLeftToPay();
			$psgExcursions = PassangerExcursion::where('reservationId','=',$reservation->id)
									->where('passangerId','=',$psg->id)->get();
			foreach ($psgExcursions as $psgExc) {
				$excursion = Excursion::find($psgExc->excursion_id);
				if (preg_match('/\bpopust\b/i', $excursion->excursionItem) == 1) {
					$pltpi->left_to_pay_din -= ($excursion->priceDin);
					$pltpi->left_to_pay_eur -= ($excursion->priceEur);
				} else {
					$pltpi->left_to_pay_din += ($excursion->priceDin);
					$pltpi->left_to_pay_eur += ($excursion->priceEur);
				}
			}
			$excursion_payments = Excursion_payment::where('reservation_id','=',$reservation->id)->
									where('passanger_id','=',$psg->id)->
									where('status','=',1)->get();
			foreach ($excursion_payments as $exc_payment) {
				$pltpi->left_to_pay_din -= $exc_payment->amount_din;
				$pltpi->left_to_pay_eur -= round($exc_payment->amount_eur_din/$exc_payment->exchange_rate, 2);
			}
			$prd->passanger_left_to_pay_i[$psg->id] = $pltpi;
		}
		$payments = Payment::where('reservation_id','=',$reservation->id)->
									where('status','=',1)->get();
		$prd->left_to_pay_din = $reservation->price_total_din;
		$prd->left_to_pay_eur = $reservation->price_total_eur;
		foreach ($payments as $payment) {
			$prd->left_to_pay_din -= $payment->amount_din;
			$prd->left_to_pay_eur -= round($payment->amount_eur_din/$payment->exchange_rate, 2);
		}

		$res_excs = Reservation_excursion::where('reservationId','=',$reservation->id)->get();
		foreach ($res_excs as $res_exc) {
			$excursion = Excursion::find($res_exc->excursionId);
			$prd->left_to_pay_din_i += $excursion->priceDin*$res_exc->num;
			$prd->left_to_pay_eur_i += $excursion->priceEur*$res_exc->num;
		}
		$excursion_payments = Excursion_payment::where('reservation_id','=',$reservation->id)->
									where('status','=',1)->get();
		foreach ($excursion_payments as $exc_payment) {
			$prd->left_to_pay_din_i -= $exc_payment->amount_din;
			$prd->left_to_pay_eur_i -= round($exc_payment->amount_eur_din/$exc_payment->exchange_rate, 2);
		}

		return Response::json(array('data' => json_encode($prd)));
	}

}

class PaymentResDetails {
	public $reservation_number;
	public $reservation_id;
	public $passanger_names = array();
	public $passanger_names_i = array();
	public $left_to_pay_din;
	public $left_to_pay_eur;
	public $passanger_left_to_pay = array();
	public $left_to_pay_din_i;
	public $left_to_pay_eur_i;
	public $passanger_left_to_pay_i = array();
}

class PsgLeftToPay {
	public $left_to_pay_eur = 0;
	public $left_to_pay_din = 0;
}
?>