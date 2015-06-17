<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CustomerCustomersGroupTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create('zh_CN');

		foreach(range(1, 12) as $index)
		{
			CustomerCustomersGroup::create([
                'customer_id' => $faker->numberBetween(1,10),
                'group_id' => $faker->numberBetween(1,10)

			]);
		}
	}

}