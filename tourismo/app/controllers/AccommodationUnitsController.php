<?php

class AccommodationUnitsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function typeUnitsList()
	{
		$query = Input::get('q','');
		$types = Accomodation_units::where("name","LIKE","%".$query."%")->get(array("name"))->toArray();

		return Response::json(array('data' => $types));
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

	public function storeArray($accId)
	{

		$units = $_POST["Unit"];

		if(is_array($units))
		{
			foreach ($units as $unit) {
				$newUnit = new Accomodation_units;
				$newUnit->accommodations_id = $accId;
				$newUnit->name = $unit["name"];
				$newUnit->capacity = $unit["capacity"];
				$newUnit->number = $unit["number"];

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


	public function updateArray()
	{
		$units = $_POST["Units"];

		if(is_array($units))
		{
			foreach ($units as $unit) {
				$id = $unit["id"];
				Accomodation_units::where("id","=",$id)->update(array("name" => $unit["name"], "capacity" => $unit["capacity"], "number" => $unit["number"]));
			}
		}
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