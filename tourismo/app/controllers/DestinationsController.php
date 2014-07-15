<?php

class DestinationsController extends \BaseController {

	public function appendValue($data, $type, $element)
	{
	  // operate on the item passed by reference, adding the element and type
	  foreach ($data as $key => & $item) {
	    $item[$element] = $type;
	  }
	  return $data;   
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$destinations = Destination::orderBy('id', 'DESC')->paginate(15);

		$categories = array('0' => 'Izaberite kategoriju') + Categories::lists("name","id");
		$countries = array('0' => "Izaberite zemlju") + Destination::lists("country","country");
		$towns = array('0' => "Izaberite grad") + Destination::lists("town","country");
		$organizers = array('0' => 'Izaberite agenciju') + Organizers::lists("name","pib");
		return View::make('destinations', array( 'categories' => $categories, 'countries' => $countries, 'towns' => $towns, 'organizers' => $organizers))->nest('destPartial','dstPartial', array('destinations' => $destinations));
	}

	public function autosearch()
	{
		$query = Input::get('q','');

		 //if(!$query && $query == '') return Response::json(array(), 400);

		 $towns = Destination::where('town','LIKE','%'.$query.'%')->get(array('town as term'))->toArray();
		 $countries = Destination::where('country','LIKE','%'.$query.'%')->get(array('country as term'))->toArray();

		 $towns = $this->appendValue($towns,'town','class');
		 $countries = $this->appendValue($countries,'country','class');

		 $data = array_merge($countries, $towns);

		 return Response::json(array('data' => $data));
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
		$country = Input::get('country');
		$town = Input::get('town');
		$description = Input::get('description');

		$destination = new Destination;
		$destination->country = $country;
		$destination->town = $town;
		$destination->description = $description;

		$destination->Save();

		return $destination;
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
		$column = Input::get('name');
		$value = Input::get('value');
		Destination::where('id','=',$id)->update(array($column => $value));
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function basicSearch()
	{
		$searchTerm = Input::get('search_item','');
		$destinations = null;
		if($searchTerm == "*")
			$destinations = Destination::orderBy('id', 'DESC')->paginate(15);
		else
			$destinations = Destination::where('country','LIKE','%'.$searchTerm.'%')->orWhere('town','LIKE','%'.$searchTerm.'%')->orderBy('id', 'DESC')->paginate(15);
		return View::make('dstPartial', array('destinations' => $destinations));
	}

	public function advancedSearch()
	{
		$category = Input::get('categories');
		$country = Input::get('countries');
		$town = Input::get('towns');
		$organizer = Input::get('organizers');

		$destinations = Destination::query();

		if($category != 0)
			$destinations->whereHas('traveldeals', function($q) use ($category){
				$q->where('category_id',$category);
			});

		if($organizer != 0)
			$destinations->whereHas('traveldeals', function($q) use ($organizer){
				$q->where('organizer_id',$organizer);
			});

		if($country != '0')
			$destinations->where('country','LIKE', '%'.$country.'%');

		if($town != '0')
			$destinations->where('town','LIKE','%'.$town.'%');

		return View::make('dstPartial', array('destinations' => $destinations->get()));
	}

//test za pretragu; ne koristi se u aplikaciji
	public function Search($search_item)
	{
		$destinations = null;
		if($search_item == "*")
			$destinations = Destination::all();
		else
			$destinations = Destination::where('country','LIKE','%'.$search_item.'%')->orWhere('town','LIKE','%'.$search_item.'%')->get();
		return View::make('dstPartial', array('destinations' => $destinations));
	}

}