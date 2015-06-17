<?php

class ShopTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        $merchants = Merchant::all();
        foreach($merchants as $merchant){
            Shop::create([
                'name' => $faker->name,
                'logo_image_id'     => $faker->numberBetween(1,30),
                'cover_image_id'    => $faker->numberBetween(1,30),
                'weixin'            => $faker->phoneNumber(),
                'intro'             => $faker->sentence(),
                'merchant_id'       => $merchant->id
            ]);
        }

    }
}
