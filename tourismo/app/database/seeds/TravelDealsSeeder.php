// app/database/seeds/TravelDealsTableSeeder.php

<?php

class TravelDealsSeeder extends Seeder
{

	public function run()
	{
		$deals = array(
			array(
			'category_id' => '1',
			'organizer_id' => '112233445',
			'destination_id' => '4',
			'accomodation_id' => '1',
			'transportation' => 'bus',
			'service' => 'Polupansion',
			'price_din' => '',
			'price_eur' => '',
			),
			array(
			'category_id' => '2',
			'organizer_id' => '112233445',
			'destination_id' => '5',
			'accomodation_id' => '2',
			'transportation' => 'bus',
			'service' => 'HB',
			'price_din' => '',
			'price_eur' => '',
			),
			array(
			'category_id' => '3',
			'organizer_id' => '123456789',
			'destination_id' => '6',
			'accomodation_id' => '3',
			'transportation' => 'avio',
			'service' => 'PP',
			'price_din' => '',
			'price_eur' => '',
			),);
		DB::table('travel_deals')->insert($deals);
		
	}

}