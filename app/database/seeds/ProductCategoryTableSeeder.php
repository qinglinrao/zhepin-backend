<?php

class ProductCategoryTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        // 共24个分类(4 + 4 * 5)
        for ($first = 0; $first < 4; $first++) {
            $first_category = ProductCategory::create([
                'name'              => $faker->name.' 一级',
                'parent_id'         => null
            ]);

            for ($second=0; $second < 5; $second++) {
                $second_category = ProductCategory::create([
                    'name'              => $faker->name.' 二级',
                    'parent_id'         => $first_category->id
                ]);

            }
        }
    }
}
