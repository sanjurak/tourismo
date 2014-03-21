// app/database/seeds/AccomodationsSeeder.php

<?php

class AccomodationsSeeder extends Seeder
{

	public function run()
	{
		$accomodations = array(
			array(
			'type' => 'hotel',
			'name' => 'Adonis',
			'destination_id' => '4',
			),
			array(
			'type' => 'Apartman',
			'name' => 'Villa Maria',
			'destination_id' => '5',
			),
			array(
			'type' => 'Villa',
			'name' => 'Madrid',
			'destination_id' => '6',
			));
		DB::table('accomodations')->insert($accomodations);
		
	}

}