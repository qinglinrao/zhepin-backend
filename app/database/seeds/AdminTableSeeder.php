<?php

class AdminTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for($i=0;$i<3;$i++){
            Admin::create([
                'email' => $faker->email,
                'mobile' => $faker->phoneNumber,
                'password' => Hash::make('123456'),
                'emp_no' => $faker->numberBetween(2000,3000)
            ]);
        }

    }
}
