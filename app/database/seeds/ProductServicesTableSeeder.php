<?php

class ProductServicesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            '七天退货' => '七天内不满意无条件退货',
            '限时送达' => '保证3天内送达'
        ];

        foreach($services as $key => $service)
        {
            ProductService::create([
                'name' => $key,
                'note' => $service,
            ]);
        }
    }
}
