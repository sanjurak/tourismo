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
		 $reservations = Reservation::where('reservation_number','LIKE',$query.'%')->get(array('reservation_number AS name'))->toArray();

		 $jmbgs = $this->appendValue($jmbgs,'jmbg','class');
		 $reservations = $this->appendValue($reservations,'name','class');
		 
		// var_dump($all_surnames);
		 $data = array_merge($jmbgs, $reservations);
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
		$payments = null;
		
		if($searchTerm == "*")
			$payments = Payment::paginate(10);
		else {
			$reservation = Reservation::where('reservation_number','LIKE',$searchTerm.'%')->get();
			if (count($reservation) == 0) {
				$passanger = Passanger::where('jmbg','LIKE',$searchTerm.'%')->get();
				if (count($passanger) > 0) {
					$payments = Payment::where("passanger_id",'=',$passanger->first()->id)->get();
				}
			} else {
				$payments = Payment::where('reservation_id','=',$reservation->first()->id)->get();
			}
		}
		return View::make('paymentsPartial', array('payments' => $payments));
	}

	public function details()
	{
		$id = Input::get('payment_id','');
		$payment = Payment::find($id);
		$extended = App::make('ExtendedPayment');
		if ($payment == null) {
			return '{"data":null}';
		} else {
			$extended->id = $payment->id;
	    	$extended->payment_type = $payment->payment_type;
		    $extended->card_type = $payment->card_type;
		    $extended->passanger_name = $payment->passanger->name;
		    $extended->passanger_surname = $payment->passanger->surname;
		    $extended->passanger_jmbg = $payment->passanger->jmbg;
		    $extended->reservation_number = $payment->reservation->reservation_number;
		    $extended->date = $payment->date;
		    $extended->exchange_rate = $payment->exchange_rate;
		    $extended->amount_din = $payment->amount_din;
		    $extended->amount_eur_din = $payment->amount_eur_din;
		    $extended->payment_method = $payment->payment_method;
		    $extended->description = $payment->description;
		    $extended->fiscal_slip = $payment->fiscal_slip;

			return Response::json(array('data' => $extended->toJson()));
		}
	}
}