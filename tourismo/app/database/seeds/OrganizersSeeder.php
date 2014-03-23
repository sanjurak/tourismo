// app/database/seeds/OrganizersTableSeeder.php

<?php

class OrganizersSeeder extends Seeder
{

	public function run()
	{
		$organizers = array(
			array(
			'pib' => '123456789',
			'mat_br' => '123456789876',
			'name' => 'Rapsody Travel',
			'email' => 'rapsody@travel.com',
			'address' => '',
			'phone' => '',
			'web' => '',
			),
			array(
			'pib' => '314263746',
			'mat_br' => '',
			'name' => 'Argus Tours',
			'email' => 'argus@tours.com',
			'address' => '',
			'phone' => '',
			'web' => '',
			),
			array(
			'pib' => '112233445',
			'mat)br' => '',
			'name' => 'Oktopod tours',
			'email' => 'oktopod@tours.com',
			'address' => '',
			'phone' => '',
			'web' => '',
			),
		);
		DB::table('organizers')->insert($organizers);
		
	}

}