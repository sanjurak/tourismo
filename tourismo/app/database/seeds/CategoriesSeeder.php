// app/database/seeds/CategoriesSeeder.php

<?php

class CategoriesSeeder extends Seeder
{

	public function run()
	{
		$categories = array(
			array(
			'name' => 'Leto 2014'
			),
			array(
			'name' => 'Uskrs 2014'
			),
			array(
			'name' => 'Prvi maj 2014'
			));
		DB::table('categories')->insert($categories);
		
	}

}