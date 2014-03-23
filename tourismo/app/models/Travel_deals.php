<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Travel_deals extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'travel_deals';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function organizer()
	{
		return $this->belongsTo('Organizers');
	}

	public function category()
	{
		return $this->belongsTo('Categories');
	}

	public function destination()
	{
		return $this->belongsTo('Destination');
	}
}