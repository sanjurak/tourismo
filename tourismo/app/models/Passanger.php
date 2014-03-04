<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Passanger extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'passanger';
	protected $primaryKey = 'id';
	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

}