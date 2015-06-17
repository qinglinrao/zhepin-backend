<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CustomerDetailTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create('zh_CN');

		$customers = Customer::all();
        foreach($customers as $customer)
		{
			CustomerDetail::create([
                'username' => $faker->name,
                'region_id' => $faker->numberBetween(1,3000),
                'skin_type_id' => $faker->numberBetween(1,5),
                'birthday' => $faker->date(),
                'sex' => $faker->boolean(),
                'image_id' => $faker->numberBetween(1,30),
                'customer_id' => $customer->id
			]);
		}
	}

}