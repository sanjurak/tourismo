<?php

class PassangersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$passangers = Passanger::paginate(10);
		return View::make('passangers', array('passangers' => $passangers))->nest('psgPartial','psgPartial', array('passangers' => $passangers));
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
		$jmbg = Passanger::where('jmbg','=',Input::get('jmbg'));
		if($jmbg->count() > 0) {
			$birth_date = date('Y-m-d', strtotime(Input::get('birth_date')));
			if ((string)$birth_date == "1970-01-01") {
				$birth_date = '';
			}
			Passanger::find($jmbg->firstOrFail()->id)->update(array(
				'jmbg' => Input::get('jmbg'),
				'name' => Input::get('name'),
				'surname' => Input::get('surname'),
				'address' => Input::get('address'),
				'gender' => Input::get('gender'),
				'tel' => Input::get('tel'),
				'mob' => Input::get('mob'),
				'passport' => Input::get('passport'),
				'birth_date' => $birth_date
			));
		} else {
			$passanger->jmbg = Input::get('jmbg');
			$passanger->name = Input::get('name');
			$passanger->surname = Input::get('surname');
			$passanger->address = Input::get('address');
			$passanger->gender = Input::get('gender');
			$passanger->tel = Input::get('tel');
			$passanger->mob = Input::get('mob');
			$passanger->passport = Input::get('passport');
			$birth_date = date('Y-m-d', strtotime(Input::get('birth_date')));
			// $birth_date = new DateTime();
			// $birth_date = Input::get('birth_date');
			if ((string)$birth_date != "1970-01-01") {
				$passanger->birth_date = $birth_date;
			}
			$passanger->save();
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
		$column = Input::get('name');
		$value = Input::get('value');
		Passanger::where('id','=',$id)->update(array($column => $value));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Passanger::destroy($id);
		return Redirect::back();
	}

	public function autosearch()
	{
		$query = Input::get('q','');

		 //if(!$query && $query == '') return Response::json(array(), 400);

		 $jmbgs = Passanger::where('jmbg','LIKE',$query)->get(array('jmbg AS name'))->toArray();
		 $names = Passanger::where('name','LIKE','%'.$query.'%')->get(array('name AS name'))->toArray();
		 $surnames = Passanger::where('surname','LIKE','%'.$query.'%')->get(array('surname AS name'))->toArray();
		 $addresses = Passanger::where('address','LIKE','%'.$query.'%')->get(array('address AS name'))->toArray();

		 $jmbgs = $this->appendValue($jmbgs,'jmbg','class');
		 $names = $this->appendValue($names,'name','class');
		 $surnames = $this->appendValue($surnames,'surname','class');
		 $addresses = $this->appendValue($addresses,'address','class');

		 $data = array_merge($jmbgs, $names, $surnames, $addresses);

		 return Response::json(array('data' => $data));
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
		$searchTerm = Input::get('search_item','');
		$passangers = null;
		if($searchTerm == "*")
			$passangers = Passanger::all();
		else
			$passangers = Passanger::where('jmbg','LIKE','%'.$searchTerm.'%')->orWhere('name','LIKE','%'.$searchTerm.'%')->orWhere('surname','LIKE','%'.$searchTerm.'%')->orWhere('address','LIKE','%'.$searchTerm.'%')->get();
		return View::make('psgPartial', array('passangers' => $passangers));
	}

	public function details()
	{
		$id = Input::get('psg_id','');
		$passanger = Passanger::findOrFail($id);
		return Response::json(array('data' => $passanger->toJson()));
	}
}