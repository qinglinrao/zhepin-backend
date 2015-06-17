<?php

class AdviserTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for($i = 0;$i<10;$i++){
            Adviser::create([
                'admin_id' => $faker->numberBetween(1,3),
                'role_id' => $faker->numberBetween(1,3)
            ]);
        }

    }
}
