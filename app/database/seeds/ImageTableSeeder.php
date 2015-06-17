<?php

class ImageTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        $categories = array(
            'abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife',
            'fashion', 'people', 'nature', 'sports', 'technics', 'transport'
        );

        for ($first = 0; $first < 10; $first++) {
            $images_count = $faker->numberBetween($min = 1, $max = 20);

            for ($image_second = 0; $image_second < $images_count; $image_second++) {
                Image::create([
                    'name' => $faker->name,
                    'url' => $faker->imageUrl($width = 640, $height = 480, $categories[array_rand($categories)]),

                    'file_path' => '',
                    'file_type' => 'jpg',
                    'file_size' => $faker->randomNumber(),

                    'used' => $faker->boolean(5),
                    'common' => $faker->boolean(5),

                    'use_count' => $faker->randomNumber(),
                    'sort_order' => $faker->randomNumber(),

                ]);
            }
        }
    }
}
