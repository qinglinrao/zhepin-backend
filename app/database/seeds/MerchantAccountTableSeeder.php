<?php

class MerchantAccountTableSeeder extends Seeder
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
            $merchant_account = MerchantAccount::create([
                'bank_account_id'  => '4562547895412357894',
                'bank_account_name' => $merchant->username,
                'bank_name' => $faker->name,
                'identity_up_image_id' => $faker->numberBetween(1,30),
                'identity_down_image_id' => $faker->numberBetween(1,30),
                'status' => $faker->numberBetween(1,2),
                'merchant_id' => $merchant->id
            ]);
        }



    }
}
