<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PassangerPrice extends Eloquent {

	protected $guarded = array('id');
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'passanger_prices';
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