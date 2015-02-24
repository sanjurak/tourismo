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
		$excursionSer = Excursion::search("", "", "", "");
		$excursions = array();
		$exc_map = array();
		foreach ($excursionSer as $excSer) {
			if (isset($exc_map[$excSer->passangerId.'-'.$excSer->reservationId])) {
				$excursion = $exc_map[$excSer->passangerId.'-'.$excSer->reservationId];
				$old_exc = $excursion;
				$excursion->excursionItem .= ', '.$excSer->excursionItem;
				$excursion->amount_din += $excSer->priceDin;
				$excursion->amount_eur += $excSer->priceEur;
				$key = array_search($old_exc, $excursions);
				if($key!==false){
    				unset($excursions[$key]);
				}
				array_push($excursions, $excursion);
				$exc_map[$excSer->passangerId.'-'.$excSer->reservationId] = $excursion;
				continue;
			}
			$excursion = new Excursions();
			$excursion->id = $excSer->excursion_id;
			$excursion->passanger_id = $excSer->passangerId;
			$excursion->res_id = $excSer->reservationId;
			$excursion->name = $excSer->name;
			$excursion->surname = $excSer->surname;
			$excursion->jmbg = $excSer->jmbg;
			$excursion->reservation_number = $excSer->reservation_number;
			$excursion->excursionItem = $excSer->excursionItem;
			$excursion->amount_din = $excSer->priceDin;
			$excursion->amount_eur = $excSer->priceEur;
			array_push($excursions, $excursion);
			$exc_map[$excSer->passangerId.'-'.$excSer->reservationId] = $excursion;
		}
		// dd(json_encode($exc_map));
		return View::make('excursions', array('excursions' => $excursions))->nest('excursionsPartial','excursionsPartial', array('excursions' => $excursions));
	}

	public function basicExcursionsSearch()
	{
		$cat = Input::get('cat_item','');
		$dst = Input::get('dst_item','');
		$from = DateTime::createFromFormat('d-m-Y', Input::get('from_item',''));
		$to = DateTime::createFromFormat('d-m-Y', Input::get('to_item',''));
		
		$excursionSer = Excursion::search($cat, $dst, $from, $to);
		$excursions = array();
		$exc_map = array();
		foreach ($excursionSer as $excSer) {
			if (isset($exc_map[$excSer->passangerId.'-'.$excSer->reservationId])) {
				$excursion = $exc_map[$excSer->passangerId.'-'.$excSer->reservationId];
				$old_exc = $excursion;
				$excursion->excursionItem .= ', '.$excSer->excursionItem;
				$excursion->amount_din += $excSer->priceDin;
				$excursion->amount_eur += $excSer->priceEur;
				$key = array_search($old_exc, $excursions);
				if($key!==false){
    				unset($excursions[$key]);
				}
				array_push($excursions, $excursion);
				$exc_map[$excSer->passangerId.'-'.$excSer->reservationId] = $excursion;
				continue;
			}
			$excursion = new Excursions();
			$excursion->id = $excSer->excursion_id;
			$excursion->passanger_id = $excSer->passangerId;
			$excursion->res_id = $excSer->reservationId;
			$excursion->name = $excSer->name;
			$excursion->surname = $excSer->surname;
			$excursion->jmbg = $excSer->jmbg;
			$excursion->reservation_number = $excSer->reservation_number;
			$excursion->excursionItem = $excSer->excursionItem;
			$excursion->amount_din = $excSer->priceDin;
			$excursion->amount_eur = $excSer->priceEur;
			array_push($excursions, $excursion);
			$exc_map[$excSer->passangerId.'-'.$excSer->reservationId] = $excursion;
		}
		return View::make('excursionsPartial', array('excursions' => $excursions));
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