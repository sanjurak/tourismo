<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Excursion_payment extends Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'excursion_payments';
	
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
}