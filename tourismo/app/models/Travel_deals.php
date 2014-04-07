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
		return $this->belongsTo('Organizers', 'organizer_id');
	}

	public function category()
	{
		return $this->belongsTo('Categories', 'category_id', 'id');
	}

	public function destination()
	{
		return $this->belongsTo('Destination', 'destination_id');
	}

	public function accomodations()
	{
		return $this->belongsTo('Accomodations', 'accomodations_id');
	}
}