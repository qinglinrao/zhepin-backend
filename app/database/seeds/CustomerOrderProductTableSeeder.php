<?php

class CustomerOrderProductTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for ($order=0; $order < ORDER_NUMBER; $order++)
        {
            $range = $faker->numberBetween(1, 5);
            for ($i = 0; $i < $range; $i++)
            {
                CustomerOrderProduct::create([
                    'name' => $faker->sentence(6),
                    'price' => $faker->randomFloat(2, 20, 888), // 48.8932
                    'total' => $faker->randomFloat(2, 500, 8988), // 48.8932
                    'sku' => '',
                    'quantity' => $faker->numberBetween($min = 1, $max = 10),
                    'option_set' => '',
                    'order_id' => $order,
                    'product_id' => $faker->numberBetween($min = 1, $max = PRODUCT_NUMBER),
                    'product_entity_id' => $faker->numberBetween($min = 1, $max = 100),
                    'shop_id' => $faker->numberBetween($min = 1, $max = 60),
                    'shop_product_id' => $faker->numberBetween($min = 1, $max = 180),
                ]);
            }
        }
    }
}
