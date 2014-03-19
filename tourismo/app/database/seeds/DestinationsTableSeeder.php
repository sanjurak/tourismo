// app/database/seeds/DestinatonsTableSeeder.php

<?php

class DestinationsTableSeeder extends Seeder
{

	public function run()
	{
		$destinations = array(
			array(
			'country' => 'Greece',
			'town' => 'Levkas',
			'description' => 'Lefkada island is bla bla bla',
			),
			array(
				'country' => 'Italy',
				'town' => 'Florence',
				'description' => 'Florence is bla bla bla',
			),
			array(
				'country' => 'Spain',
				'town' => 'Malaga',
				'description' => 'Malaga is bla bla bla',
		));
		DB::table('destinations')->insert($destinations);
		
	}

}