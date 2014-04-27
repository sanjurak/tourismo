<?php

class TravelDealController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$travel_deals = Travel_deals::paginate(10);
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
		$travel_deal = new Travel_deals;
		$trvl_dl = Travel_deals::find(Input::get('id'));
		$categories = Categories::where('name', 'LIKE', Input::get('category'))->get();
		$category_id = 0;
		if ($categories->count() > 0)
			$category_id = $categories->toArray()[0]['id'];
		else {
			$category = new Categories;
			$category->name = Input::get('category');
			$category->save();
			$category_id = $category->id;
		}
		$organizer_id = Organizers::where('name', 'LIKE', Input::get('organizer'))->get()->toArray()[0]['pib'];
		$dsts = explode(', ', Input::get('destination'));
		$destination_id = Destination::where('town', 'LIKE', $dsts[0])->where('country', 'LIKE', $dsts[1])->get()->toArray()[0]['id'];
		$accomodations_id = Accomodations::where('destination_id', '=', $destination_id)->
			where('name', 'LIKE', Input::get('accom_name'))->
			where('type', 'LIKE', Input::get('accom_type'))->get()->toArray[0]['id'];
		if($trvl_dl != null) {
			$trvl_dl->update(array(
				'category_id' => $category_id,
				'organizer_id' => $organizer_id,
				'destination_id' => $destination_id,
				'accomodation_unit_id' => Accomodation_units::where('accomodations_id', '=', $accomodations_id)->get()->id,
				'transportation' => Input::get('transportation'),
				'service' => Input::get('service'),
				'price_din' => Input::get('price_din'),
				'price_eur' => Input::get('price_eur')
			));
		} else {
			$travel_deal->category_id = $category_id;
			$travel_deal->organizer_id = $organizer_id;
			$travel_deal->destination_id = $destination_id;
			$travel_deal->accomodation_unit_id = Accomodation_units::where('accomodations_id', '=', $accomodations_id)->get()->id;
			$travel_deal->transportation = Input::get('gender');
			$travel_deal->service = Input::get('tel');
			$travel_deal->price_din = Input::get('mob');
			$travel_deal->price_eur = Input::get('passport');
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
			$travel_deals = Travel_deals::paginate(10);
		elseif ($dst == "") {
			$categories = Categories::where('name','LIKE',$cat)->get();
			$travel_deals = Travel_deals::where('category_id','=',$categories->first()->id)->get();
			// dd($travel_deals);
		} elseif ($cat == "") {
			$dsts = explode(', ', $dst);
			$destinations = Destination::where('town', 'LIKE', $dsts[0])->where('country', 'LIKE', $dsts[1])->get();
			$travel_deals = Travel_deals::where('destination_id','=',$destinations->first()->id)->get();
		} else {
			$categories = Categories::where('name','LIKE',$cat)->get();
			$dsts = explode(', ', $dst);
			$destinations = Destination::where('town', 'LIKE', $dsts[0])->where('country', 'LIKE', $dsts[1])->get();
			$travel_deals = Travel_deals::where('category_id','=',$categories->first()->id)->where('destination_id','=',$destinations->first()->id)->get();
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