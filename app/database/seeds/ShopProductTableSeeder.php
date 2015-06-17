<?php

class ShopProductTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');
        $shops = Shop::all();
        foreach($shops as $shop){
            $random = $faker->numberBetween(20,40);
            for($i = 0;$i<$random;$i++){
                ShopProduct::create([
                    'shop_id'           => $faker->numberBetween(1,300),
                    'product_id'        => $faker->numberBetween(1,10),
                    'merchant_id'       => $faker->numberBetween(1,60)
                ]);
            }
        }


    }
}
