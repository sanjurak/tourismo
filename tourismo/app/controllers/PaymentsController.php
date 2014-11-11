<?php

class PaymentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$payments = Payment::orderBy('id', 'DESC')->paginate(15);
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
		
		$payment->reservation_id = Input::get('reservation_id');
		$payment->passanger_id = Input::get('passanger_search');
		$payment->payment_type = Input::get('payment_type');
		$payment->card_type = Input::get('card_type');
		$date = date('Y-m-d', strtotime(Input::get('res_date')));
		if ((string)$date != "1970-01-01") {
			$payment->date = $date;
		}
		$payment->exchange_rate = Input::get('exchange_rate');
		$payment->amount_din = Input::get('amount_din');
		$payment->amount_eur_din = Input::get('amount_eur_eur')*Input::get('exchange_rate');
		$payment->fiscal_slip = Input::get('fiscal_slip');
		$payment->description = Input::get('description');
		
		$payment->save();
		
		return Response::json(array('status' => "success", 'id' => $payment->id));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeExcursionPayment()
	{
		$payment = new Excursion_payment;
		
		$payment->reservation_id = Input::get('reservation_id');
		$payment->passanger_id = Input::get('passanger_search');
		$date = date('Y-m-d', strtotime(Input::get('res_date')));
		if ((string)$date != "1970-01-01") {
			$payment->date = $date;
		}
		$payment->exchange_rate = Input::get('exchange_rate');
		$payment->amount_din = Input::get('amount_din');
		$payment->amount_eur_din = Input::get('amount_eur_eur')*Input::get('exchange_rate');
		$payment->description = Input::get('description');
		
		$payment->save();
		
		return Response::json(array('status' => "success", 'id' => $payment->id));
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
		Payment::where('id','=',$id)->update(array($column=>$value));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Payment::where('id','=',$id)->update(array('status'=>2));
		Session::flash('success',  "Uspešno storniranje plaćanja");
		return Redirect::back();
	}

	public function autosearch()
	{
		$query = Input::get('q','');

		 $jmbgs  = Passanger::whereRaw("CONCAT (jmbg,' ',name,' ',surname) LIKE '$query%'")->select(DB::Raw("CONCAT (jmbg,' ',name,' ',surname) AS name"))->get()->toArray();
		// $jmbgs = Passanger::where('jmbg','LIKE',$query.'%')->get(array('jmbg AS name'))->toArray();
		 $reservations = Reservation::where('reservation_number','LIKE',$query.'%')->get(array('reservation_number AS name'))->toArray();

		 $jmbgs = $this->appendValue($jmbgs,'jmbg','class');
		 $reservations = $this->appendValue($reservations,'reservation_number','class');
		 
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
			$payments = Payment::orderBy('id', 'DESC')->paginate(15);
		else {
			$reservation = Reservation::where('reservation_number','LIKE',$searchTerm.'%')->orderBy('id', 'DESC')->paginate(15);
			if (count($reservation) == 0) {
				$passanger = Passanger::where('jmbg','LIKE',explode(' ',$searchTerm)[0].'%')->orderBy('id', 'DESC')->paginate(15);
				if (count($passanger) > 0) {
					$payments = Payment::where("passanger_id",'=',$passanger->first()->id)->orderBy('id', 'DESC')->paginate(15);
				}
			} else {
				$payments = Payment::where('reservation_id','=',$reservation->first()->id)->orderBy('id', 'DESC')->paginate(15);
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

	public function paymentSlip($id)
	{
		$payment = Payment::find($id);
		$passanger = Passanger::find($payment->passanger_id);
		$reservation = Reservation::find($payment->reservation_id);
		
		$pdf = null;
		try{
			$pdf = PDF::loadView('reports//payment_slip', array('reservation' => $reservation, 'passanger' => $passanger, 'payment' => $payment), array(),'UTF-8')->setPaper('a4')->stream('PAYMENT.pdf');
			//return View::make('reports//payment_slip', array('reservation' => $reservation, 'passanger' => $passanger, 'payment' => $payment));
		}
		catch(\Exception $e)
		{
			return Response::json(array('status' => "failure", 'message' => $e->getMessage()));
		}
		
		return $pdf;
	}

}