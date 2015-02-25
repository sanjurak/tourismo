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

	public static function debts()
	{
		$passangerPrices = PassangerPrice::orderBy("passanger_id", "ASC")
							->orderBy("reservation_id", "ASC")->get();
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
				$passanger = Passanger::find($passanger_id);
				$debt->passanger_name = $passanger->name.' '.$passanger->surname;
				$debt->passanger_jmbg = $passanger->jmbg;
				$debt->passanger_address = $passanger->address;
				$debt->passanger_tel = $passanger->mob;
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
										where('status', '=', 1)->get();
				foreach ($payments as $payment) {
					$paymentReservation = Reservation::find($payment->reservation_id);
					if ($paymentReservation && $paymentReservation->id == $reservationPsg->reservation_id) {
						$reservationPsg->left_to_pay_din -= floatval($payment->amount_din);
						$reservationPsg->left_to_pay_eur -= round(floatval($payment->amount_eur_din)/$payment->exchange_rate,2);
					
						$debt->debt_din -= floatval($payment->amount_din);
						$debt->debt_eur -= round(floatval($payment->amount_eur_din)/$payment->exchange_rate,2);
					}
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