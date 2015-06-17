<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CustomerGroupTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create('zh_CN');

		foreach(range(1, 10) as $index)
		{
			CustomerGroup::create([
				'name' => $faker->name,
				'note' => $faker->sentence(6)
			]);
		}
	}

}