<?php

class MerchantTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('zh_CN');
        //代理商
        for($i=0;$i<20;$i++){
           $merchant = Merchant::create([
               'username'           => $faker->userName,
               'email'              => $faker->companyEmail,
               'mobile'             => $faker->phoneNumber,
               'encrypted_password' => Hash::make('123456'),
               'image_id'           => $faker->numberBetween(1,20),
               'real_name'          => $faker->name,
               'identity_num'       => $faker->uuid,
               'sex'                => $faker->boolean(),
               'status'             => $faker->numberBetween(0,3),
               'merchant_grade'     => 1,
               'leader_id'          => 0,
               'follower_num'       => $faker->numberBetween(1,20),
               'age'                => $faker->numberBetween(10,80),
               'region_id'          => $faker->numberBetween(1,2000),
               'total_pay'          => $faker->randomFloat(),
               'follower_profit'    => $faker->randomFloat(),
               'shop_profit'        => $faker->randomFloat(),
               'total_profit'       => $faker->randomFloat(),
               'money'              => $faker->randomFloat()
           ]);
        }

        //门店
        for($i=0;$i<20;$i++){
            $merchant = Merchant::create([
                'username'           => $faker->userName,
                'email'              => $faker->companyEmail,
                'mobile'             => $faker->phoneNumber,
                'encrypted_password' => Hash::make('123456'),
                'image_id'           => $faker->numberBetween(1,20),
                'real_name'          => $faker->name,
                'identity_num'       => $faker->uuid,
                'sex'                => $faker->boolean(),
                'status'             => $faker->numberBetween(0,3),
                'merchant_grade'     => 2,
                'leader_id'          => $faker->numberBetween(1,20),
                'follower_num'       => $faker->numberBetween(1,20),
                'age'                => $faker->numberBetween(10,80),
                'region_id'          => $faker->numberBetween(1,2000),
                'total_pay'          => $faker->randomFloat(),
                'follower_profit'    => $faker->randomFloat(),
                'shop_profit'        => $faker->randomFloat(),
                'total_profit'       => $faker->randomFloat(),
                'money'              => $faker->randomFloat()
            ]);
        }

        //BA
        for($i=0;$i<20;$i++){
            $merchant = Merchant::create([
                'username'           => $faker->userName,
                'email'              => $faker->companyEmail,
                'mobile'             => $faker->phoneNumber,
                'encrypted_password' => Hash::make('123456'),
                'image_id'           => $faker->numberBetween(1,20),
                'real_name'          => $faker->name,
                'identity_num'       => $faker->uuid,
                'sex'                => $faker->boolean(),
                'status'             => $faker->numberBetween(0,3),
                'merchant_grade'     => 3,
                'leader_id'          => $faker->numberBetween(21,40),
                'follower_num'       => $faker->numberBetween(1,20),
                'age'                => $faker->numberBetween(10,80),
                'region_id'          => $faker->numberBetween(1,2000),
                'total_pay'          => $faker->randomFloat(),
                'follower_profit'    => $faker->randomFloat(),
                'shop_profit'        => $faker->randomFloat(),
                'total_profit'       => $faker->randomFloat(),
                'money'              => $faker->randomFloat()
            ]);
        }


    }
}
