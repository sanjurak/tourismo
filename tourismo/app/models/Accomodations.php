<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Accomodations extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'accomodations';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	public function units()
	{
		return $this->hasMany('Accomodation_units','accommodations_id');
	}

	
	public function destination()
	{
		return $this->belongsTo('Destination');
	}

	public function getUnitsHTMLAttribute()
	{
		$response = "<table><tr><th>Tip</th><th>Kapacitet</th><th>Broj</th></tr>";
		foreach ($this->units as $unit) {
			$response .= "<tr><td>".$unit->name."</td><td>".$unit->capacity."</td><td>".$unit->number."</td></tr>";
		}
		$response .= "</table>";

		return $response;
	}

	public function delete()
	{
		Accomodation_units::where("accommodations_id","=",$this->id)->delete();
		return parent::delete();
	}
}