<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PassangerExcursion extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'passanger_excursions';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function passangerId()
	{
		return $this->belongsTo('Passanger', 'passanger_id');
	}

	public function reservationId()
	{
		return $this->belongsTo('Reservation', 'reservation_id');
	}

	public function getPassanger()
	{
		$pas = Passanger::find($this->passangerId);
		return $pas;
	}

	public function getReservation()
	{
		$res = Reservation::find($this->reservationId);
		return $res;
	}
}