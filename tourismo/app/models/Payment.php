<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Payment extends Eloquent {

	protected $guarded = array('id');
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'payments';
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

	public function passanger()
	{
		return $this->belongsTo('Passanger', 'passanger_id');
	}

	public function reservation()
	{
		return $this->belongsTo('Reservation', 'reservation_id');
	}

	public function getReservation()
	{
		$res = Reservation::find($this->reservation_id);
		return $res;
	}

	public function payment_status()
	{
		if ($this->status == 1)
			return "";
		else
			return "tr-alert";
	}

	public static function incomesForPeriod($cat, $dst, $from, $to)
	{
		$incomes = null;
		$paymsel = DB::table('payments')
	            ->join('reservations', 'reservations.id', '=', 'payments.reservation_id')
	            ->join('travel_deals', 'travel_deals.id', '=', 'reservations.travel_deal_id')
	            ->join('destinations', 'destinations.id', '=', 'travel_deals.destination_id')
	            ->join('categories', 'categories.id', '=', 'travel_deals.category_id')
	            ->select('categories.name', 'payments.reservation_id', 'payments.date AS date', 'payments.exchange_rate', 'payments.amount_din', 'payments.amount_eur_din', 'reservations.reservation_number', 'reservations.travel_date', 'destinations.country', 'destinations.town')
	            ->where('payments.status', '=', '1');
	    $excsel = DB::table('excursion_payments')
	            ->join('reservations', 'reservations.id', '=', 'excursion_payments.reservation_id')
	            ->join('travel_deals', 'travel_deals.id', '=', 'reservations.travel_deal_id')
	            ->join('destinations', 'destinations.id', '=', 'travel_deals.destination_id')
	            ->join('categories', 'categories.id', '=', 'travel_deals.category_id')
	            ->select('categories.name', 'excursion_payments.reservation_id', 'excursion_payments.date AS date', 'excursion_payments.exchange_rate', 'excursion_payments.amount_din', 'excursion_payments.amount_eur_din', 'reservations.reservation_number', 'reservations.travel_date', 'destinations.country', 'destinations.town')
	            ->where('excursion_payments.status', '=', '1');
	    
		if ($cat != null && $cat != "") {
			$excsel = $excsel->where('categories.name', 'LIKE', $cat);
			$paymsel = $paymsel->where('categories.name', 'LIKE', $cat);
		}
		if ($dst != null && $dst != "") {
			$dsts = explode(', ', $dst);
			$excsel = $excsel->where('destinations.town', 'LIKE', $dsts[0])->where('destinations.country', 'LIKE', $dsts[1]);
			$paymsel = $paymsel->where('destinations.town', 'LIKE', $dsts[0])->where('destinations.country', 'LIKE', $dsts[1]);
		}
		if ($from != null && $from != "") {
			$from = $from->sub(new DateInterval('P1D'));
			$excsel = $excsel->where('date', '>=', $from);
			$paymsel = $paymsel->where('date', '>=', $from);
		}
		if ($to != null && $to != "") {
			// $to = $to->add(new DateInterval('P1D'));
			$excsel = $excsel->where('date', '<=', $to);
			$paymsel = $paymsel->where('date', '<=', $to);
		}

		// dd($paymsel->get());
		$insel = $paymsel->union($excsel);
		$incomes = $insel->orderBy('date')->get();
		
		return $incomes;
	}
}