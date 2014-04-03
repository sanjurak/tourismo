<?php

class AccommodationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$accomodations = Accomodations::all();
		$destinationsList = Destination::select(DB::raw('concat (town,", ",country) as destination, id'))->lists("destination","id");
		return View::make("accomodations",array('destinations' => $destinationsList ))->nest("accPartial","accPartial",array('accomodations' => $accomodations));
	}

	public function dstList()
	{
		return Destination::select(DB::raw('concat (town,", ",country) as destination, id'))->lists("destination","id");
	}

	public function typeList()
	{
		$query = Input::get('q','');
		$types = Accomodations::where("type","LIKE","%".$query."%")->get(array('type AS name'))->toArray();

		return Response::json(array('data' => $types));
	}

	private function appendValue($data, $type, $element)
	{
	  // operate on the item passed by reference, adding the element and type
	  foreach ($data as $key => & $item) {
	    $item[$element] = $type;
	  }
	  return $data;   
	}

	public function autocompleteSearch(){
		$query = Input::get('q','');

		$names = Accomodations::where("name","LIKE","%".$query."%")->get(array("name"))->toArray();
		$types = Accomodations::where("type","LIKE","%".$query."%")->get(array("type as name"))->toArray();
		$destinations = Destination::where("town","LIKE","%".$query."%")->orWhere("country","LIKE","%".$query."%")->get(array("id", "town", "country"))->toArray();
		
		//->get(array(DB::raw("destination as name")))->toArray();

		//Accomodations::join('destinations','accomodations.destination_id','=','destinations.id')->select(DB::raw('concat (destinations.town,", ",destinations.country) as destination'))->where("destination","LIKE","%".$query."%")->get(array("destination as name"))->toArray();
		
		 $names = $this->appendValue($names,'names','class');
		 $types = $this->appendValue($types,'type','class');
		 $destinations = $this->appendValue($destinations,'destination','class');

		 $data = array_merge($names, $types, $destinations);

		  return Response::json(array('data' => $data));
	}

	public function basicSearch()
	{
		$searchTerm = Input::get('search_item','');

		$town = $searchTerm;
		$country = $searchTerm;

		if(strpos($searchTerm,',') !== FALSE)
		{
			$str = str_replace(' ', '', $searchTerm);
			$strs = explode(',', $str);
			$town = $strs[0];
			$country = $strs[1];
		}
		$destinations = null;
		if($searchTerm == "*")
			$accomodations = Accomodations::all();
		else
			$accomodations = Accomodations::join("destinations","destinations.id","=","accomodations.destination_id")
											->where('type','LIKE','%'.$searchTerm.'%')
											->orWhere('name','LIKE','%'.$searchTerm.'%')
											->orWhere('town','LIKE','%'.$town.'%')
											->orWhere('country','LIKE','%'.$country.'%')->get();
		return View::make('accPartial', array('accomodations' => $accomodations));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$destinationsList = Destination::select(DB::raw('concat (town,", ",country) as destination, id'))->lists("destination","id");

		return View::make("newAccomodation", array('destinations' => $destinationsList));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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
		$acc = Accomodations::findOrFail($id);
		$units = $acc->units();
		return View::make('editUnitsPartial', array('units' => $units->get()));
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
		Accomodations::where('id','=',$id)->update(array($column => $value));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 $acc = Accomodations::findOrFail($id);
		 $acc->delete();
	}

	public function getUnitsArray($id)
	{
		 $acc =  Accomodations::findOrFail($id);
		 return $acc->units()->toArray();
	}

}