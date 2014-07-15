<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Passangers extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'passangers';

	
	/**
	 * Get the unique identifier for the reservation.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->id;
	}

	/**
	 * Check if User can be deleted
	 *
	 * @return boolean
	 */
	public static function canDelete($id)
	{
		$psg = Passangers::where('passanger_id','=',$id)->get();
		if ($psg->count()>0)
			return false;
		else 
			return true;
	}

}