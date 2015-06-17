<?php

class RoleTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for($i = 0;$i<3;$i++){
            Role::create([
                'name' => $faker->name,
                'code' => $faker->languageCode,
                'detail' => $faker->sentence()
            ]);
        }

    }
}
