<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Reservation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reservations';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function traveldeal()
	{
		return $this->belongsTo('Travel_deals','travel_deal_id');
	}
	
	public function passanger()
	{
		return $this->belongsTo('Passanger','passanger_id');
	}

	public function prices()
	{
		return $this->hasMany('Reservation_price','reservationId');
	}
	
	public function payment_status()
	{
		if($this->reservation_id)
			$id = $this->reservation_id;
		else
			$id = $this->id;
		$payments = Payment::where('reservation_id','=',$id)->get();
		$left_to_pay_din = $this->price_total_din;
		$left_to_pay_eur = $this->price_total_eur;
		foreach ($payments as $payment) {
			$left_to_pay_din -= $payment->amount_din;
			if ($payment->exchange_rate != 0)
				$left_to_pay_eur -= round($payment->amount_eur_din/$payment->exchange_rate, 2);
		}
		
		if ($left_to_pay_din <= 10 && $left_to_pay_eur <= 1)
			return "tr-success $id";
		if(time() > strtotime($this->travel_date))
			return "tr-error $id";
		if(time() > (strtotime($this->travel_date)-(60*60*24*5)))
			return "tr-alert $id";
		return "$id";
	}

	public function destination()
	{
		$trvl_dl = Travel_deals::find($this->travel_deal_id);
		$dest = Destination::find($trvl_dl->destination_id);
		return $dest->country." ".$dest->town;
	}
}