<?php

class ReportsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('reports');
	}

	public function excursions()
	{
		$excursions = Excursion::excursionSearch("", "", "", "");
		// dd(json_encode($exc_map));
		return View::make('excursions', array('excursions' => $excursions))->nest('excursionsPartial','excursionsPartial', array('excursions' => $excursions));
	}

	public function basicExcursionsSearch()
	{
		$cat = Input::get('cat_item','');
		$dst = Input::get('dst_item','');
		$from = DateTime::createFromFormat('d-m-Y', Input::get('from_item',''));
		$to = DateTime::createFromFormat('d-m-Y', Input::get('to_item',''));
		
		$excursions = Excursion::excursionSearch($cat, $dst, $from, $to);
		return View::make('excursionsPartial', array('excursions' => $excursions));
	}

	public function incomeforperiod()
	{
		$incomes = Payment::incomesForPeriod("", "", "", "");
		return View::make('incomeforperiod', array('incomes' => $incomes))->nest('incomeForPeriodPartial','incomeForPeriodPartial', array('incomes' => $incomes));
	}

	public function basicIncomesSearch()
	{
		$cat = Input::get('cat_item','');
		$dst = Input::get('dst_item','');
		$from = DateTime::createFromFormat('d-m-Y', Input::get('from_item',''));
		$to = DateTime::createFromFormat('d-m-Y', Input::get('to_item',''));
		
		$incomes = Payment::incomesForPeriod($cat, $dst, $from, $to);
		return View::make('incomeForPeriodPartial', array('incomes' => $incomes));
	}

	public function promoters()
	{
		$passangers = Passanger::promoters("", "", "", "");
		return View::make('promoters', array('passangers' => $passangers))->nest('promotersPartial','promotersPartial', array('passangers' => $passangers));
	}

	public function basicPromotersSearch()
	{
		$cat = Input::get('cat_item','');
		$dst = Input::get('dst_item','');
		$from = DateTime::createFromFormat('d-m-Y', Input::get('from_item',''));
		$to = DateTime::createFromFormat('d-m-Y', Input::get('to_item',''));
		
		$passangers = Passanger::promoters($cat, $dst, $from, $to);
		return View::make('promotersPartial', array('passangers' => $passangers));
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
		
	}

	public function details()
	{
		
	}
}

class Excursions {
	public $id;
	public $passanger_id;
	public $res_id;
	public $name;
	public $surname;
	public $jmbg;
	public $reservation_number;
	public $excursionItem;
	public $amount_din;
	public $amount_eur;
}