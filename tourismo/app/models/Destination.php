<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Destination extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'destinations';
	protected $appends = array('name');

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function getNameAttribute()
	{
		return $this->town .", " . $this->country;
	}

	public function accomodations()
	{
		return $this->hasMany('Accomodations');
	}

	public function traveldeals()
	{
		return $this->hasMany('Travel_deals');
	}
}