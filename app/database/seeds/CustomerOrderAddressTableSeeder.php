<?php

class CustomerOrderAddressTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for ($i = 0; $i < 100; $i++) {
            CustomerOrderAddress::create([
                'name' => $faker->name(),
                'address' => $faker->address(),
                'mobile' => $faker->phoneNumber(), // 48.8932
                'telephone' => $faker->phoneNumber(),
                'alias' => $faker->address(),
                'order_id' => $faker->numberBetween($min = 1, $max = 50),
                'region_id' => $faker->numberBetween($min = 1, $max = 100)

            ]);
        }
    }
}
