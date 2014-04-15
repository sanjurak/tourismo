<?php

class DisplayTrvlDeal
	{
		public $id;
	    public $category;
	    public $destination;
	    public $organizer;
	    public $accom_type;
	    public $accom_name;
	    public $transportation;
	    public $service;
	    public $price_din;
	    public $price_eur;
	    
	    public function toJson() {
	        return json_encode($this);
	    }

	}