<?php
function unique_rand($min, $max, $num) {
    $count = 0;
    $return = array();
    while ($count < $num) {
        $return[] = mt_rand($min, $max);
        $return = array_flip(array_flip($return));
        $count = count($return);
    }
    shuffle($return);
    return $return;
}

class ProductEntityTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        $product_option = ProductOption::with('values')->get();

        for ($i = 1; $i <= 10; $i++)
        {
            $option_number = $faker->numberBetween(1, 3);
            $option_unique_rand = unique_rand(1, 3, $option_number);
            foreach ($option_unique_rand as $option_key => $option_value)
            {
                $value_number = $faker->numberBetween(1, 2);
                $value_unique_rand = unique_rand(1, 2, $value_number);
                foreach ($value_unique_rand as $key => $value) {
                    $option = $product_option[$option_key];
                    $option_value = $product_option[$option_key]->values[$key];

                    // 建立选中的选项值
                    $product_option_value = ProductOptionValue::create([
                        'option_id' => $option->id,
                        'mapping_value_id' => $option_value->id,
                        'name' => $option_value->name
                    ]);

                    ProductOptionsProduct::create([
                        'product_id' => $i,
                        'option_id' => $option->id,
                        'option_value_id' => $option_value->id
                    ]);

                    $new_options[$option_key]['values'][] = $option_value;
                    $aaa[$option_key]['values'][] = $option_value->toArray();

                    // 键值映射
                    $value_mapping[$option_value->id] = [
                        'id' => $product_option_value->id,
                        'name' => $option->name.':'.$product_option_value->name
                    ];
                }

            }

        }
    }



}