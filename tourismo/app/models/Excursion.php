<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Excursion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'excursion';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}
	
	public static function search($cat, $dst, $from, $to)
	{
		$excursions = null;
		$excsel = DB::table('passanger_excursions')
	            ->join('passanger', 'passanger_excursions.passangerId', '=', 'passanger.id')
	            ->join('reservations', 'reservations.id', '=', 'passanger_excursions.reservationId')
	            ->join('travel_deals', 'travel_deals.id', '=', 'reservations.travel_deal_id')
	            ->join('destinations', 'destinations.id', '=', 'travel_deals.destination_id')
	            ->join('excursion', 'excursion.id', '=', 'passanger_excursions.excursion_id')
	            ->join('excursion_payments', 'passanger.id', '=', 'passanger_excursions.passangerId')
	            ->join('categories', 'categories.id', '=', 'travel_deals.category_id')
	            ->select('passanger_excursions.*', 'passanger.name', 'passanger.surname', 'passanger.jmbg', 'reservations.reservation_number', 'reservations.travel_date', 'destinations.country', 'destinations.town', 'excursion.*')
	            ->where('reservations.status', '!=', 'Storno');
		if ($cat != null && $cat != "")
			$excsel = $excsel->where('categories.name', 'LIKE', $cat);
		if ($dst != null && $dst != "") {
			$dsts = explode(', ', $dst);
			$excsel = $excsel->where('destinations.town', 'LIKE', $dsts[0])->where('destinations.country', 'LIKE', $dsts[1]);
		}
		if ($from != null && $from != "") {
			$from = $from->sub(new DateInterval('P1D'));
			$excsel = $excsel->where('reservations.travel_date', '>=', $from);
		}
		if ($to != null && $to != "") {
			// $to = $to->add(new DateInterval('P1D'));
			$excsel = $excsel->where('reservations.travel_date', '<=', $to);
		}

		$excursions = $excsel->groupBy("passanger_excursions.id")
							->orderBy('reservations.travel_date')
							->get();
		return $excursions;
	}
}