<?php

class PaymentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$payments = Payment::paginate(10);
		return View::make('payments', array('payments' => $payments))->nest('paymentsPartial','paymentsPartial', array('payments' => $payments));
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
		$payment = new Payment;
		
		$passanger->jmbg = Input::get('jmbg');
		$passanger->name = Input::get('name');
		$passanger->surname = Input::get('surname');
		$passanger->address = Input::get('address');
		$passanger->gender = Input::get('gender');
		$passanger->tel = Input::get('tel');
		$passanger->mob = Input::get('mob');
		$passanger->passport = Input::get('passport');
		$birth_date = date('Y-m-d', strtotime(Input::get('birth_date')));
		if ((string)$birth_date != "1970-01-01") {
			$passanger->birth_date = $birth_date;
		}
		$passanger->save();
		
		return Redirect::back();
	}

	public function addNew() {
		
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
		Payments::where('id','=',$id)->update(array($column=>$value));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

	public function autosearch()
	{
		$query = Input::get('q','');

		 $jmbgs = Passanger::where('jmbg','LIKE',$query.'%')->get(array('jmbg AS name'))->toArray();
		 $names = Passanger::where('name','LIKE','%'.$query.'%')->get(array('name AS name'))->toArray();
		 $surnames = Passanger::where('surname','LIKE','%'.$query.'%')->get(array('surname AS name'))->toArray();
		 $addresses = Passanger::where('address','LIKE','%'.$query.'%')->get(array('address AS name'))->toArray();

		 $names_surnames = Passanger::whereRaw("CONCAT (name,' ',surname) LIKE '$query%'")->select(DB::Raw("CONCAT (name,' ',surname) AS name"))->get()->toArray();
		 $names_surnames_addresses = Passanger::whereRaw("CONCAT (name,' ',surname,' ',address) LIKE '$query%'")->select(DB::Raw("CONCAT (name,' ',surname,' ',address) AS name"))->get()->toArray();
		 
		 $jmbgs = $this->appendValue($jmbgs,'jmbg','class');
		 $names = $this->appendValue($names,'name','class');
		 $surnames = $this->appendValue($surnames,'surname','class');
		 $addresses = $this->appendValue($addresses,'address','class');
		 $names_surnames = $this->appendValue($names_surnames,'name_surname','class');
		 $names_surnames_addresses = $this->appendValue($names_surnames_addresses,'name_surname_address','class');

		// var_dump($all_surnames);
		 $data = array_merge($jmbgs, $names, $surnames, $addresses, $names_surnames, $names_surnames_addresses);
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
			$passangers = Passanger::paginate(10);
		else {
			$passangers = Passanger::where('jmbg','LIKE','%'.$searchTerm.'%')->orWhere('name','LIKE','%'.$searchTerm.'%')->orWhere('surname','LIKE','%'.$searchTerm.'%')->orWhere('address','LIKE','%'.$searchTerm.'%')->get();
			if (count($passangers) == 0) {
				$passangers = Passanger::whereRaw("CONCAT (name,' ',surname) LIKE '$searchTerm%'")->get();
				if (count($passangers) == 0) {
					$passangers = Passanger::whereRaw("CONCAT (name,' ',surname,' ',address) LIKE '$searchTerm%'")->get();
			}
			}
		}
		return View::make('psgPartial', array('passangers' => $passangers));
	}

	public function details()
	{
		$id = Input::get('payment_id','');
		$payment = Paayment::find($id);
		if ($payment == null) {
			return '{"data":null}';
		} else
			return Response::json(array('data' => $payment->toJson()));
	}
}