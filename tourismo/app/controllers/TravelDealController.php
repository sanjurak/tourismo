<?php

class TravelDealController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$travel_deals = Travel_deals::orderBy('id', 'DESC')->paginate(15);
		return View::make('travel_deals', 
			array('travel_deals' => $travel_deals))->nest(
			'trvlDealsPartial','trvlDealsPartial', array('travel_deals' => $travel_deals));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$trvl_dl = Travel_deals::find(Input::get('id'));
		$categories = Categories::where('name', 'LIKE', Input::get('category'))->get();
		if ($categories->count() > 0) {
			$category_id = $categories->toArray()[0]['id'];
		}
		else {
			$category = new Categories;
			$category->name = Input::get('category');
			$category->save();
			Session::flash('success', 'Dodata nova kategorija \"$category->name\"!');
			$category_id = $category->id;
		}
		$organizer_id = Organizers::where('name', 'LIKE', Input::get('organizer'))->get()->toArray()[0]['pib'];
		$dsts = explode(', ', Input::get('destination'));
		$destination_id = Destination::where('town', 'LIKE', $dsts[0])->where('country', 'LIKE', $dsts[1])->get()->toArray()[0]['id'];
		$accomodations = Accomodations::where('destination_id', '=', $destination_id)->
			where('name', 'LIKE', Input::get('accom_name'))->
			where('type', 'LIKE', Input::get('accom_type'))->get();
		if ($accomodations->count() == 0) {
			Session::flash('error', 'Smeštaj ne postoji!');
			return Redirect::back();
		}
		$accomodations_id = $accomodations->toArray()[0]['id'];
		
		if($trvl_dl != null) {
			$trvl_dl->category_id = $category_id;
			$trvl_dl->organizer_id = $organizer_id;
			$trvl_dl->destination_id = $destination_id;
			$trvl_dl->accomodation_unit_id = Accomodation_units::where('accommodations_id', '=', $accomodations_id)->get()->toArray()[0]['id'];
			$trvl_dl->transportation = Input::get('transportation');
			$trvl_dl->service = Input::get('service');
			$trvl_dl->price_din = floatval(Input::get('price_din'));
			$trvl_dl->price_eur = floatval(Input::get('price_eur'));
			$trvl_dl->save();
		} else {
			$travel_deal = new Travel_deals;
			$travel_deal->category_id = $category_id;
			$travel_deal->organizer_id = $organizer_id;
			$travel_deal->destination_id = $destination_id;
			$travel_deal->accomodation_unit_id = Accomodation_units::where('accommodations_id', '=', $accomodations_id)->get()->toArray()[0]['id'];
			$travel_deal->transportation = Input::get('transportation');
			$travel_deal->service = Input::get('service');
			$travel_deal->price_din = floatval(Input::get('price_din'));
			$travel_deal->price_eur = floatval(Input::get('price_eur'));
			$travel_deal->save();
		}
		return Redirect::back();
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
		Travel_deals::destroy($id);
		return Redirect::back();
	}

	public function addNew()
	{
		$traveldeal = new Travel_deals;
		$traveldeal->category_id = Input::get('category');
		$traveldeal->organizer_id = Input::get("organizer");
		$traveldeal->destination_id = Input::get("destination");
		$traveldeal->accomodation_unit_id = Input::get("accomodation");
		$traveldeal->transportation = Input::get("transportation");
		$traveldeal->service = Input::get("service");
		$traveldeal->price_din =  Input::get("priceDin");
		$traveldeal->price_eur =  Input::get("priceEur");

		$traveldeal->Save();

		Session::flash('success', 'Novi aranžman je dodat');
		return $traveldeal;
	}

	public function autosearchCat()
	{
		$query = Input::get('q','');
		$dst = Input::get('dst','');
		$queries = explode(' ', $query);

		$categories = null;
		if ($dst == '' || $dst == null) {
			foreach ($queries as $query) {
			  if ($categories == null)
			  	$categories = Categories::where('name','LIKE',$query.'%');
			  else
			  	$categories->where('name','LIKE',$query.'%');
			}
		} 
		else {
			// $dst = utf8_encode($dst);
			// var_dump($dst);
			$dsts = explode(', ', $dst);
			$destinations = Destination::where('town', 'LIKE', $dsts[0])->where('country', 'LIKE', $dsts[1])->get();
			// $travel_deals = travel_deals::where('destination_id','=',$destinations->first()->id)->get();
			$categories = Categories::query();
			$categories->whereHas('traveldeals', function($q) use ($destinations){
				$q->where('destination_id',$destinations->first()->id);
			});
		}
		
		$all_categories = $categories->get(array('name AS name'))->toArray();
		$all_categories = $this->appendValue($all_categories,'categories','class');
		 // $data = array_merge($categories);
		return Response::json(array('data' => $all_categories));
	}

	public function autosearchDst()
	{
		$queries = null;
		$query = Input::get('q','');
		$cat = Input::get('cat','');
		if(strpos($query, ', ') !== FALSE)
			$queries = explode(', ', $query);
		elseif(strpos($query, ' ') !== FALSE)
			$queries = explode(' ', $query);

		$destinations = null;
		if($cat == '' || $cat == null)
		{
			if ($queries == null) {
				$destinations = Destination::where("country", "LIKE", "$query%")->orWhere("town", "LIKE", "$query%");
			} else {
				foreach ($queries as $query) {
				  if ($destinations == null)
				  	$destinations = Destination::where("country", "LIKE", "$query%")->orWhere("town", "LIKE", "$query%");
				  else
				  	$destinations->where("country", "LIKE", "$query%")->orWhere("town", "LIKE", "$query%");
				}
			}
		} else {
			$categories = Categories::where('name','LIKE',$cat)->get();
			$destinations = Destination::query();
			$destinations->whereHas('traveldeals', function($q) use ($categories){
				$q->where('category_id',$categories->first()->id);
			});
		}
		
		$all_destinations = $destinations->get(array('country', 'town'))->toArray();
		$all_destinations = $this->appendValue($all_destinations,'destinations','class');
		 // $data = array_merge($categories);
		return Response::json(array('data' => $all_destinations));
	}

	public function appendValue($data, $type, $element)
	{
	  // operate on the item passed by reference, adding the element and type
	  foreach ($data as $key => & $item) {
	    $item[$element] = $type;
	  }
	  return $data;   
	}

	/**
	 * Searches for resource from storage.
	 *
	 * @return Response
	 */
	public function basicSearch()
	{
		$cat = Input::get('cat_item','');
		$dst = Input::get('dst_item','');
		$travel_deals = null;
		
		if (($cat == "" || $cat == null) && ($dst == "" || $dst == null))
			$travel_deals = Travel_deals::orderBy('id', 'DESC')->paginate(15);
		elseif ($dst == "") {
			$categories = Categories::where('name','LIKE',$cat)->get();
			$travel_deals = Travel_deals::where('category_id','=',$categories->first()->id)->orderBy('id', 'DESC')->paginate(15);
			// dd($travel_deals);
		} elseif ($cat == "") {
			$dsts = explode(', ', $dst);
			$destinations = Destination::where('town', 'LIKE', $dsts[0])->where('country', 'LIKE', $dsts[1])->get();
			$travel_deals = Travel_deals::where('destination_id','=',$destinations->first()->id)->orderBy('id', 'DESC')->paginate(15);
		} else {
			$categories = Categories::where('name','LIKE',$cat)->get();
			$dsts = explode(', ', $dst);
			$destinations = Destination::where('town', 'LIKE', $dsts[0])->where('country', 'LIKE', $dsts[1])->get();
			$travel_deals = Travel_deals::where('category_id','=',$categories->first()->id)->where('destination_id','=',$destinations->first()->id)
			->orderBy('id', 'DESC')->paginate(15);
		}

		return View::make('trvlDealsPartial', array('travel_deals' => $travel_deals));
	}

	public function details()
	{
		$id = Input::get('trvlDls_id','');
		$travel_deal = Travel_deals::find($id);
		if ($travel_deal == null) {
			return '{"data":null}';
		} else {
			$displayTD = App::make('DisplayTrvlDeal');
			$destinationObj = Destination::where('id', '=', $travel_deal->destination_id)->get();
			$destination = $destinationObj->toArray()[0]['town'].', '.$destinationObj->toArray()[0]['country'];
			$accomodation_unit = Accomodation_units::find($travel_deal->accomodation_unit_id);
			$accomodation_id = $accomodation_unit->accommodations_id;
			$accomodation = Accomodations::find($accomodation_id);
			$accom_type = $accomodation->type;
			$accom_name = $accomodation->name;
			$displayTD->id = $travel_deal->id;
			$displayTD->category = Categories::where('id', '=', $travel_deal->category_id)->get()->toArray()[0]['name'];
			$displayTD->organizer = Organizers::where('pib', '=', $travel_deal->organizer_id)->get()->toArray()[0]['name'];
			$displayTD->destination = $destination;
			$displayTD->accom_name = $accom_name;
			$displayTD->accom_type = $accom_type;
			$displayTD->service = $travel_deal->service;
			$displayTD->transportation = $travel_deal->transportation;
			$displayTD->price_din = $travel_deal->price_din;
			$displayTD->price_eur = $travel_deal->price_eur;

			return Response::json(array('data' => $displayTD->toJson()));
		}
	}

}