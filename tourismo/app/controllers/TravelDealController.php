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
			  	$categories = Categories::where('name','LIKE','%'.$query.'%');
			  else
			  	$categories->where('name','LIKE','%'.$query.'%');
			}
		} 
		else {
			$destinations = Destination::whereRaw('CONCAT (town, ", ", country) LIKE %$dst%')->get();
			// $travel_deals = travel_deals::where('destination_id','=',$destinations->first()->id)->get();
			$categories = Categories::query();
			$categories->whereHas('traveldeals', function($q) use ($destinations){
				$q->where('destination_id',$destinations);
			});
		}
		
		$all_categories = $categories->get(array('name AS name'))->toArray();
		$all_categories = $this->appendValue($all_categories,'categories','class');
		 // $data = array_merge($categories);
		return Response::json(array('data' => $all_categories));
	}

	public function autosearchDst()
	{
		$query = Input::get('q','');
		$cat = Input::get('cat','');
		$queries = explode(' ', $query);

		if($cat == '' || $cat == null)
		{
			$destinations = null;
			foreach ($queries as $query) {
			  if ($destinations == null)
			  	$destinations = Destination::where("country", "LIKE", "%$query%")->orWhere("town", "LIKE", "%$query%");
			  else
			  	$destinations->where("country", "LIKE", "%$query%")->orWhere("town", "LIKE", "%$query%");
			}
		} else {
			$categories = Categories::where('name','LIKE','%'.$cat.'%');
			$destinations = Destination::query();
			$destinations->whereHas('traveldeals', function($q) use ($categories){
				$q->where('category_id',$categories);
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
			$destinations = Destination::whereRaw('CONCAT (town, ", ", country) LIKE %$dst%')->get();
			$travel_deals = travel_deals::where('destination_id','=',$destinations->first()->id)->get();
		} else {
			$categories = Categories::where('name','LIKE',$cat)->get();
			$destinations = Destination::whereRaw('CONCAT (town, ", ", country) LIKE %$dst%')->get();
			$travel_deals = Travel_deals::where('category_id','=',$categories->first()->id)->where('destination_id','=',$destinations->first()->id)->get();
		}

		return View::make('trvlDealsPartial', array('travel_deals' => $travel_deals));
	}

}