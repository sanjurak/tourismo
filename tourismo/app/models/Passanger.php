<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Passanger extends Eloquent {

	protected $guarded = array('id');
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'passanger';
	protected $primaryKey = 'id';
	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public static function psgForPeriod($cat, $dst, $from, $to)
	{
		$passangers = null;
		$psgsel = DB::table('passanger')
	            ->join('passangers', 'passangers.passanger_id', '=', 'passanger.id')
	            ->join('reservations', 'reservations.id', '=', 'passangers.reservation_id')
	            ->join('travel_deals', 'travel_deals.id', '=', 'reservations.travel_deal_id')
	            ->join('destinations', 'destinations.id', '=', 'travel_deals.destination_id')
	            ->join('accomodation_units', 'accomodation_units.id', '=', 'travel_deals.accomodation_unit_id')
	            ->join('accomodations', 'accomodations.id', '=', 'accomodation_units.accommodations_id')
	            ->join('categories', 'categories.id', '=', 'travel_deals.category_id')
	            ->select('passanger.*', 'reservations.reservation_number', 'reservations.travel_date', 'destinations.country', 'destinations.town', 'accomodations.type', 'accomodations.name AS acc_name')
	            ->where('reservations.status', '!=', 'Storno');
		if ($cat != null && $cat != "")
			$psgsel = $psgsel->where('categories.name', 'LIKE', $cat);
		if ($dst != null && $dst != "") {
			$dsts = explode(', ', $dst);
			$psgsel = $psgsel->where('destinations.town', 'LIKE', $dsts[0])->where('destinations.country', 'LIKE', $dsts[1]);
		}
		if ($from != null && $from != "") {
			$from = $from->sub(new DateInterval('P1D'));
			$psgsel = $psgsel->where('reservations.travel_date', '>=', $from);
		}
		if ($to != null && $to != "") {
			// $to = $to->add(new DateInterval('P1D'));
			$psgsel = $psgsel->where('reservations.travel_date', '<=', $to);
		}

		$passangers = $psgsel->groupBy("passanger.id")
							->orderBy('reservations.travel_date')
							->get();
		return $passangers;
	}
}