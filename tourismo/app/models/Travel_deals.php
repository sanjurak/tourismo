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

	public function accomodationUnit()
	{
		return $this->belongsTo('Accomodation_units','accomodation_unit_id');
	}

	public function reservations()
	{
		return $this->hasMany('Reservation');
	}

	public function getTravelDeal()
	{
		$response = array();
		$response["category"] = $this->category->name;
		$response["organizer"] = $this->organizer->name;
		$response["destination"] = $this->destination->name;
		$response["accomodation"] = $this->accomodationUnit->name ."/".$this->accomodationUnit->capacity;
		$response["transportation"] = $this->transportation;
		$response["service"] = $this->service;
		return $response;
	}

	public function accomodations()
	{
		return $this->belongsTo('Accomodations', 'accomodations_id');
	}
}