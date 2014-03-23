<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Categories extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function traveldeals()
	{
		return $this->hasMany('Travel_deals');
	}
}