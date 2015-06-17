<?php

class ProductTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        $category_count = ProductCategory::count();
        $image_count = Image::count();

        for ($i = 0; $i < PRODUCT_NUMBER; $i++) {
            Product::create([
                'name' => $faker->name,
                'detail' => $faker->text(),
                'note' => '',
                'sku' => $faker->unique()->word,

                'par_price' => $faker->randomFloat($nbMaxDecimals = 2, 0, 999.99),
                'sale_price' => $faker->randomFloat($nbMaxDecimals = 2, 0, 999.99),

                'image_id' => $faker->numberBetween($min = 1, $max = $image_count),
                'category_id' => $faker->numberBetween($min = 1, $max = $category_count),
                'brand_id' => 0,

                'enabled' => $faker->boolean(10),
                'visible' => $faker->boolean(10),

                'published_at' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = '30 days') ,
                'sort_order' => $faker->randomNumber(),
                'created_by' => 1,
                'updated_by' => 1,
                'sale_count' => $faker->numberBetween(100,999),
                'visit_count' => $faker->randomNumber(),
                'collection_count' => $faker->randomNumber(),
                'stock' => $faker->randomNumber(),
                'invoice' => $faker->boolean(2),
                'counting_method' => $faker->boolean(2),
                'logistics' => 1,

                'attribute_values' => '',
                'profit_id' => $faker->numberBetween(0,6),
                'profit' => $faker->numberBetween(10,300),
                'display_type' => $faker->numberBetween(1,2)
            ]);
        }
    }
}
