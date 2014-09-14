<?php

class OrganizersController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$organizers = Organizers::orderBy('name')->paginate(15);

		$matbrs = array('0' => 'Izaberite matični broj') + Organizers::lists('mat_br','mat_br');
		$pibs = array('0' => 'Izaberite PIB') + Organizers::lists('pib','pib');
		$names = array('0' => 'Izaberite naziv') + Organizers::lists('name','name');
		$addresses = array('0' => 'Izaberite adresu') + Organizers::lists('address','address');
		$phones = array('0' => 'Izaberite teelefon') + Organizers::lists('phone','phone');
		$webs = array('0' => 'Izaberite web sajt') + Organizers::lists('web','web');
		$emails = array('0' => 'Izaberite email') + Organizers::lists('email','email');

		return View::make('organizators', array('pibs' => $pibs, 'matbrs'=>$matbrs, 'names'=>$names, 'addresses'=>$addresses, 'phones'=>$phones,'webs'=>$webs,"emails"=>$emails))->nest('orgzPartial', 'orgzPartial', array('organizators' => $organizers));
	}

	public function autosearch()
	{
		$query = Input::get('q','');

		$names = Organizers::where('name','LIKE','%'.$query.'%')->get(array('name'))->toArray();
		 $addresses = Organizers::where('address','LIKE','%'.$query.'%')->get(array('address AS name'))->toArray();
		 $emails = Organizers::where('email','LIKE','%'.$query.'%')->get(array('email AS name'))->toArray();
		 $webs = Organizers::where('web','LIKE','%'.$query.'%')->get(array('web AS name'))->toArray();

		 $names = $this->appendValue($names,'names','class');
		 $addresses = $this->appendValue($addresses,'address','class');
		 $emails = $this->appendValue($emails,'email','class');
		 $webs = $this->appendValue($webs,'web','class');

		 $data = array_merge($names, $addresses, $emails, $webs);

		 //if(!$query && $query == '') return Response::json(array(), 400);

		// $organizators = Organizers::where('name','LIKE','%'.$query.'%')->get()->toArray();

		 return Response::json(array('data' => $data));
	}

	public function basicSearch()
	{
		$searchTerm = Input::get('search_item','');
		$organizators = null;
		if($searchTerm == "*")
			$organizators = Organizers::orderBy('name')->paginate(15);
		else
			$organizators = Organizers::where('name','LIKE','%'.$searchTerm.'%')->orWhere('address','LIKE','%'.$searchTerm.'%')->orWhere('email','LIKE','%'.$searchTerm.'%')->orWhere('web','LIKE','%'.$searchTerm.'%')->orderBy('name')->paginate(15);
		return View::make('orgzPartial', array('organizators' => $organizators));
	}

	private function appendValue($data, $type, $element)
	{
	  // operate on the item passed by reference, adding the element and type
	  foreach ($data as $key => & $item) {
	    $item[$element] = $type;
	  }
	  return $data;   
	}

	public function advancedSearch()
	{
		$pib = Input::get('pibs');
		$matbr = Input::get('matbrs');
		$name = Input::get('names');
		$email = Input::get('emails');
		$address = Input::get('addresses');
		$phone = Input::get('phones');
		$web = Input::get('webs');

		$organizators = Organizers::query();

		if($pib != 0)
			$organizators->where('pib','=',$pib);

		if($matbr != 0)
			$organizators->where('mat_br','=',$matbr);

		if($name != '0')
			$organizators->where('name','LIKE',$name);

		if($email != '0')
			$organizators->where('email','LIKE',$email);

		if($address != '0')
			$organizators->where('address','LIKE',$address);

		if($phone != '0')
			$organizators->where('phone','=',$phone);

		if($web != '0')
			$organizators->where('web','LIKE',$web);

		return View::make('orgzPartial', array('organizators' => $organizators->get()));
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
		$pib = Input::get('pib');
		$matbr = Input::get('mat_br');
		$email = Input::get('email');
		$address = Input::get('address');
		$web = Input::get('web');
		$name = Input::get('name');
		$phone = Input::get('phone');
		$provision = Input::get('provision');
		$licence = Input::get('licence');
		$bankaccount = Input::get('bankaccount');

		$organizator = new Organizers;

		$organizator->pib = $pib;
		$organizator->mat_br = $matbr;
		$organizator->name = $name;
		$organizator->email = $email;
		$organizator->web = $web;
		$organizator->address = $address;
		$organizator->phone = $phone;
		$organizator->provision = $provision;
		$organizator->licence = $licence;
		$organizator->bankAccount = $bankaccount;

		$organizator->Save();

		$organizator = Organizers::find($pib);

		return $organizator;
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
		Organizers::where('pib','=',$id)->update(array($column => $value));
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateAll($id)
	{
		//$pib = Input::get('pib');
		$matbr = Input::get('mat_br');
		$email = Input::get('email');
		$address = Input::get('address');
		$web = Input::get('web');
		$name = Input::get('name');
		$phone = Input::get('phone');
		$provision = Input::get('provision');
		$licence = Input::get('licence');
		$bankAccount = Input::get('bankaccount');
		Organizers::where('pib','=',$id)->
			update(array("mat_br" => $matbr,
				"email" => $email, "address" => $address,
				"web" => $web, "name" => $name, "phone" => $phone,
				"provision" => $provision, "licence" => $licence,
				"bankAccount" => $bankAccount));
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Organizers::destroy($id);
	}

}