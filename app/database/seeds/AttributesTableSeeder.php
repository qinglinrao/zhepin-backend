<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AttributesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		for ($i=0; $i < 10; $i++)
		{
			$attribute = CategoryAttribute::create([
				'name' => $faker->name,
                'note' => '',
                'input_type' => '',
                'frontend_label' => '',
                'default_value' => '',
                'required' => true,
			]);

			for ($vi=0; $vi < 5; $vi++)
			{ 
				CategoryAttributeValue::create([
					'value' => $faker->name,
					'sort_order' => $vi,
					'attribute_id' => $attribute->id,
				]);
			}
		}
	}

}