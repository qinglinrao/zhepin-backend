<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CustomersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create('zh_CN');

        for($i = 0;$i<40;$i++){
            Customer::create([
                'email' => $faker->email,
                'mobile' => $faker->PhoneNumber(),
                'encrypted_password' => Hash::make('123456'),
                'level_id' => 1,
                'order_total_pay' => $faker->numberBetween(200,20000),
                'order_total_num' => $faker->numberBetween(10,50),
                'ba_profit'  => $faker->numberBetween(1,40000),
                'store_profit' => $faker->numberBetween(20,3000),
                'agent_profit' => $faker->numberBetween(30,300),
                'total_profit' => $faker->numberBetween(2000,50000),
                'merchant_id' => $faker->numberBetween(1,20)
			]);
        }

        for($i = 0;$i<40;$i++){
            Customer::create([
                'email' => $faker->email,
                'mobile' => $faker->PhoneNumber(),
                'encrypted_password' => Hash::make('123456'),
                'level_id' => 1,
                'order_total_pay' => $faker->numberBetween(200,20000),
                'order_total_num' => $faker->numberBetween(10,50),
                'ba_profit'  => $faker->numberBetween(1,40000),
                'store_profit' => $faker->numberBetween(20,3000),
                'agent_profit' => $faker->numberBetween(30,300),
                'total_profit' => $faker->numberBetween(2000,50000),
                'merchant_id' => $faker->numberBetween(21,40)
            ]);
        }

        for($i = 0;$i<40;$i++){
            Customer::create([
                'email' => $faker->email,
                'mobile' => $faker->PhoneNumber(),
                'encrypted_password' => Hash::make('123456'),
                'level_id' => 1,
                'order_total_pay' => $faker->numberBetween(200,20000),
                'order_total_num' => $faker->numberBetween(10,50),
                'ba_profit'  => $faker->numberBetween(1,40000),
                'store_profit' => $faker->numberBetween(20,3000),
                'agent_profit' => $faker->numberBetween(30,300),
                'total_profit' => $faker->numberBetween(2000,50000),
                'merchant_id' => $faker->numberBetween(41,60)
            ]);
        }
	}

}