<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Accomodation_units extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'accomodation_units';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function accomodation()
	{
		return $this->belongsTo('Accomodations','accommodations_id');
	}

	public function travelDeal()
	{
		$this->hasOne('Travel_deals');
	}

}