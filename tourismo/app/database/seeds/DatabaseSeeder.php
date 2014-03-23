<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//$this->call('DestinationsTableSeeder');
		//$this->call('AccomodationsSeeder');
		//$this->call('CategoriesSeeder');
		//$this->call('OrganizersSeeder');
		$this->call('TravelDealsSeeder');	
	}

}