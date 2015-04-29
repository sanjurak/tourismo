<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PassangerPrice extends Eloquent {

	protected $guarded = array('id');
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'passanger_prices';
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

	public static function debts($cat, $dst, $from, $to)
	{
		$passangers = null;
		$psgsel = DB::table('passanger_prices')
				->join('passanger', 'passanger_prices.passanger_id', '=', 'passanger.id')
	            ->join('reservations', 'reservations.id', '=', 'passanger_prices.reservation_id')
	            ->join('travel_deals', 'travel_deals.id', '=', 'reservations.travel_deal_id')
	            ->join('destinations', 'destinations.id', '=', 'travel_deals.destination_id')
	            ->join('accomodation_units', 'accomodation_units.id', '=', 'travel_deals.accomodation_unit_id')
	            ->join('accomodations', 'accomodations.id', '=', 'accomodation_units.accommodations_id')
	            ->join('categories', 'categories.id', '=', 'travel_deals.category_id')
	            ->select('passanger.*', 'reservations.id AS reservation_id', 'reservations.reservation_number', 
	            	'reservations.travel_date', 'destinations.country', 'destinations.town', 'accomodations.type',
	            	 'accomodations.name AS acc_name', 'passanger_prices.price_item', 'passanger_prices.price_din', 
	            	 'passanger_prices.price_eur', 'passanger_prices.num', 'passanger.id AS passanger_id')
	            ->where('reservations.status', '!=', 'Storno')
	            ->where(function ($query) {
	            	$query->where('passanger_prices.price_din', '>', 0)
	            	      ->orWhere('passanger_prices.price_eur', '>', 0);
	            	});
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
			$psgsel = $psgsel->where('reservations.travel_date', '<=', $to);
		}

		$passangers = $psgsel
					->orderBy('passanger_id')
					->orderBy('reservation_id')
					->get();

		// dd($passangers);
		$debts = PassangerPrice::debtsCalculus($passangers);
		return $debts;
	}

	public static function debtsOld()
	{
		$passangerPrices = PassangerPrice::orderBy("passanger_id", "ASC")
							->orderBy("reservation_id", "ASC")->get();
		return debtsCalculus($passangerPrices);
	}

	public static function debtsCalculus($passangerPrices)
	{
		$debts = array();
		$passanger_id = 0;
		$debt = new Debt();
		$reservation_id = 0;
		foreach ($passangerPrices as $psgPrice) {
			$reservation = Reservation::find($psgPrice->reservation_id);
			if ($reservation->status == 'Storno' 
				|| $reservation->payment_status() == "tr-success") {
				continue;
			}

			if ($psgPrice->passanger_id > $passanger_id) {
				if ($passanger_id > 0 &&
					($debt->debt_din > 1 || $debt->debt_eur > 1)) {
					array_push($debt->reservations, $reservationPsg);
					array_push($debts, $debt);
				}
				$debt = new Debt();
				$passanger_id = $psgPrice->passanger_id;
				$debt->passanger_id = $passanger_id;
				$debt->passanger_name = $psgPrice->name.' '.$psgPrice->surname;
				$debt->passanger_jmbg = $psgPrice->jmbg;
				$debt->passanger_address = $psgPrice->address;
				$debt->passanger_tel = $psgPrice->mob;
				$reservation_id = 0;
			}

			if ($reservation_id == 0 || $reservation->id > $reservation_id) {
				if ($reservation_id > 0)
					array_push($debt->reservations, $reservationPsg);
				$reservation_id = $reservation->id;
				$reservationPsg = new ReservationPsg();
				$reservationPsg->reservation_id = $reservation_id;
				$reservationPsg->reservation_number = $reservation->reservation_number;
				$reservationPsg->res_start_date = $reservation->start_date;
				$reservationPsg->destination = $reservation->destination();

				$payments = Payment::where('passanger_id', '=', $passanger_id)->
										where('reservation_id', '=', $reservationPsg->reservation_id)->
										where('status', '=', 1)->get();
				foreach ($payments as $payment) {
					$reservationPsg->left_to_pay_din -= floatval($payment->amount_din);
					$reservationPsg->left_to_pay_eur -= round(floatval($payment->amount_eur_din)/$payment->exchange_rate,2);
				
					$debt->debt_din -= floatval($payment->amount_din);
					$debt->debt_eur -= round(floatval($payment->amount_eur_din)/$payment->exchange_rate,2);
				}
			}

			if (preg_match('/\bpopust\b/i', $psgPrice->price_item) == 1) {
				$debt->debt_din -= ($psgPrice->price_din*$psgPrice->num);
				$debt->debt_eur -= ($psgPrice->price_eur*$psgPrice->num);
				$reservationPsg->left_to_pay_din -= ($psgPrice->price_din*$psgPrice->num);
				$reservationPsg->left_to_pay_eur -= ($psgPrice->price_eur*$psgPrice->num);
			} else {
				$debt->debt_din += ($psgPrice->price_din*$psgPrice->num);
				$debt->debt_eur += ($psgPrice->price_eur*$psgPrice->num);
				$reservationPsg->left_to_pay_din += ($psgPrice->price_din*$psgPrice->num);
				$reservationPsg->left_to_pay_eur += ($psgPrice->price_eur*$psgPrice->num);
			}
		}
		if ($debt->debt_din > 1 || $debt->debt_eur > 1) {
			array_push($debt->reservations, $reservationPsg);
			array_push($debts, $debt);
		}
		return $debts;
	}
}

class Debt {
	public $reservations = array();
	public $passanger_id;
	public $passanger_name;
	public $passanger_jmbg;
	public $passanger_address;
	public $passanger_tel;
	public $debt_din = 0;
	public $debt_eur = 0;
}

class ReservationPsg {
	public $reservation_id;
	public $reservation_number;
	public $res_start_date;
	public $destination;
	public $left_to_pay_eur = 0;
	public $left_to_pay_din = 0;
}