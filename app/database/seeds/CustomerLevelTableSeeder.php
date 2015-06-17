<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CustomerLevelTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create('zh_CN');

		$levels = [
			'注册会员', '普通会员', '高级会员', 'VIP会员', '至尊VIP会员'
		];

		foreach($levels as $level)
		{
			CustomerLevel::create([
				'name' => $level,
				'note' => $faker->sentence(6),
			]);
		}
	}

}