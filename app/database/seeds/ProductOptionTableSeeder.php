<?php

class ProductOptionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for ($i = 0; $i < 3; $i++) {
            $option = ProductOption::create([
                'id' => (10000 + $i * 10),
                'name' => $faker->name
            ]);

            for ($vi = 0; $vi < 2; $vi++) {
                $option_value = ProductDefaultOptionValue::create([
                    'id' => (20000 + $i * 10 + $vi),
                    'name' => $faker->name,
                    'option_id' => $option->id
                ]);
            }
        }
    }
}
