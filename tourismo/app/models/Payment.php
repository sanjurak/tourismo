<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Payment extends Eloquent {

	protected $guarded = array('id');
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'payments';
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

	public function passanger()
	{
		return $this->belongsTo('Passanger', 'passanger_id');
	}

	public function reservation()
	{
		return $this->belongsTo('Reservation', 'reservation_id');
	}

	public function getReservation()
	{
		$res = Reservation::find($this->reservation_id);
		return $res;
	}

	public function payment_status()
	{
		if ($this->status == 1)
			return "";
		else
			return "tr-alert";
	}
}