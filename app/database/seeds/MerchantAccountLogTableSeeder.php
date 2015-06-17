<?php

class MerchantAccountLogTableSeeder extends Seeder
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
            $random = $faker->numberBetween(4,10);
            for($i = 0;$i<$random;$i++){
                $merchant_account_log = MerchantAccountLog::create([
                    'money' => $faker->numberBetween(100,1000),
                    'trade_type' => $faker->numberBetween(0,1),
                    'log' => $faker->sentence(),
                    'operate_type' => $faker->numberBetween(1,2),
//                    'merchant_account_id' => $merchant->account->id,
                    'merchant_id' => $merchant->id,
                    'bank_account_id'  => $merchant->account->bank_account_id,
                    'bank_account_name' => $merchant->username,
                    'bank_name' => $merchant->account->name,
                    'identity_up_image_id' => $merchant->account->identity_up_image_id,
                    'identity_down_image_id' => $merchant->account->identity_up_image_id,
                    'status' => $faker->numberBetween(1,2)
                ]);
            }
        }



    }
}
