<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Organizers extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'organizers';
	protected $primaryKey = 'pib';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->pib;
	}

	public function traveldeals()
	{
		return $this->hasMany('Travel_deals');
	}

}