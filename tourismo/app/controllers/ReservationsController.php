<?php

class ReservationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$reservations = Reservation::orderBy('id', 'DESC')->paginate(20);

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

		$passangers = Passanger::join("reservations","passanger.id","=","reservations.passanger_id")
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
			$reservations = Reservation::where('reservation_number','=',$searchTerm)->orWhere('passanger_id','=',$searchTerm)->orderBy('id', 'DESC')->paginate(20);
		

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
							$excursion->num = $item['num'];
							$excursion->Save();

							$resExc = new Reservation_excursion;
							$resExc->destinationId = $traveldeal->destination_id;
							$resExc->excursionId = $excursion->id;
							$resExc->reservationId = $reservation->id;
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

				if(is_array($passangersPrices))
				{
					foreach ($passangersPrices as $psgPrices) {
						
						if(is_array($psgPrices))
						{
							foreach ($psgPrices as $psgPrice) {
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
		
		$accunit = $traveldeal->accomodationUnit;
		
		$resPrices = Reservation_price::where("reservationId", "=", $id)->get();
		$excPrices = Reservation_excursion::where("reservationId", "=", $id)->get();
		
		return View::make("editReservationPartial",array('reservation' => $reservation, 
					'traveldeal' => $traveldeal, 'passangers' => $passangers, 'accunit' => $accunit, 'resPrices' => $resPrices,
					'excPrices' => $excPrices));
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
				
			$oldprices = $_POST["Prices"];
			
			if(is_array($oldprices))
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
			
			$prices = isset($_POST['Item'])?$_POST['Item'] : null;
			
			if($prices != null && is_array($prices))
			{
				foreach($prices as $item)
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
		}
		$payments = Payment::where('reservation_id','=',$reservation->id)->get();
		$prd->left_to_pay_din = $reservation->price_total_din;
		$prd->left_to_pay_eur = $reservation->price_total_eur;
		foreach ($payments as $payment) {
			$prd->left_to_pay_din -= $payment->amount_din;
			$prd->left_to_pay_eur -= round($payment->amount_eur_din/$payment->exchange_rate, 2);
		}

		return Response::json(array('data' => json_encode($prd)));
	}

}

class PaymentResDetails {
	public $reservation_number;
	public $reservation_id;
	public $passanger_names = array();
	public $left_to_pay_din;
	public $left_to_pay_eur;
}
?>