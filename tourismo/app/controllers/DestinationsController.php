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
		$destinations = Destination::all();
		return View::make('destinations')->nest('destPartial','dstPartial', array('destinations' => $destinations));
	}

	public function autosearch()
	{
		$query = Input::get('q','');

		 //if(!$query && $query == '') return Response::json(array(), 400);

		 $towns = Destination::where('town','LIKE','%'.$query.'%')->get(array('town AS name'))->toArray();
		 $countries = Destination::where('country','LIKE','%'.$query.'%')->get(array('country AS name'))->toArray();

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
		$destinations = Destination::where('country','LIKE','%'.$searchTerm.'%')->orWhere('town','LIKE','%'.$searchTerm.'%')->get();
		return View::make('dstPartial', array('destinations' => $destinations));
	}

	public function Search($search_item)
	{
		$destinations = Destination::where('country','LIKE','%'.$search_item.'%')->orWhere('town','LIKE','%'.$search_item.'%')->get();
		return View::make('dstPartial', array('destinations' => $destinations));
	}

}