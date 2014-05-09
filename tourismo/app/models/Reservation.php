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
}