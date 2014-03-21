<?php

class PassangersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('passangers');
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
		$passanger = new Passanger;
		$passanger->name = Input::get('name');
		$passanger->surname = Input::get('surname');
		$passanger->address = Input::get('address');
		$passanger->gender = Input::get('gender');
		$passanger->tel = Input::get('tel');
		$passanger->mob = Input::get('mob');
		$passanger->passport = Input::get('passport');
		var_dump(Input::get('birth_date'));
		if ((string)Input::get('birth_date') != "0000-00-00") {
			$passanger->birth_date = Input::get('birth_date');
		}
		$passanger->save();
		return Redirect::intended('passangers');
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