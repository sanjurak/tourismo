<?php

class ExtendedPayment
	{
		public $id;
	    public $payment_type;
	    public $card_type;
	    public $passanger_name;
	    public $passanger_surname;
	    public $passanger_jmbg;
	    public $reservation_number;
	    public $date;
	    public $exchange_rate;
	    public $amount_din;
	    public $amount_eur_din;
	    public $payment_method;
	    public $description;
	    public $fiscal_slip;
	    
	    public function toJson() {
	        return json_encode($this);
	    }

	}
