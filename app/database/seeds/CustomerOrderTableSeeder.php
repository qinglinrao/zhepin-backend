<?php

class CustomerOrderTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for ($i = 0; $i < ORDER_NUMBER; $i++) {
            CustomerOrder::create([
                'order_sn' => $faker->unique()->word,
                'order_title' => $faker->sentence(6),
                'total' => $faker->randomFloat(NULL, 0, 8888), // 48.8932
                'note' => '快点发货',
                'status_id' => $faker->numberBetween($min = 1, $max = 11),
                'status_name' => '',
                'customer_id' => $faker->numberBetween($min = 1, $max = 10),
                'with_invoice' => $faker->numberBetween($min = 0, $max = 1),
                'invoice_head' => $faker->sentence(6),
                'message' => $faker->text(),
                'payment_method' => $faker->word(),
//                'shop_id' => $faker->numberBetween(1,30),
//                'merchant_id' => $faker->numberBetween(1,300)
                'adviser_id' => $faker->numberBetween(0,10),
                'order_type' => $faker->numberBetween(1,2)
            ]);
        }
    }
}
