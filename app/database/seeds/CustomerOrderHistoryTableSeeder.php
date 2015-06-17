<?php

class CustomerOrderHistoryTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for ($i = 0; $i < 500; $i++) {
            $status_id = rand(0,10);
            CustomerOrderHistory::create([
                'comment' => $this->get_status_name()[$status_id],
                'order_id' => $faker->numberBetween($min = 1, $max = 50),
                'status_id' => $status_id,
                'status_name' => $this->get_status_name()[$status_id]
            ]);
        }
    }

    function get_status_name(){
        return array(
            0 => '买家取消订单',
            1 => '买家已下单',
            2 => '买家已付款',
            3 => '商家已发货',
            4 => '物流签收',
            5 => '买家已评论',
            6 => '买家申请退款',
            7 => '商家已退款',
            8 => '已确认到帐',
            9 => '商家拒绝退款',
            10 => '商家关闭订单',
        );

    }
}
