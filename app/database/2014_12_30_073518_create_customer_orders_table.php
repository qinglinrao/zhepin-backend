<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_orders', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('order_sn');
            $table->string('order_title');
            $table->decimal('total', 8, 2);
            $table->integer('count')->default(0);
            $table->string('note')->nullable();

            $table->integer('status_id')->unsigned();
            $table->string('status_name');

            $table->integer('customer_id')->unsigned();

			$table->boolean('with_invoice')->default(0);
			$table->string('invoice_head')->nullable();

			$table->text('message')->nullable();

			$table->string('payment_method');
			$table->text('notify_data')->nullable(); //全部一起保存成 json 数据

            $table->integer('shop_id')->default(0); //店铺编号
//            $table->integer('merchant_id')->default(0) ;//商家编号 或 专家编号 （当订单类型为2时，填写专家编号）
            $table->integer('adviser_id')->default(0); //默认为0 如果该订单是由专家推荐购买的，则填写专家编号
            $table->tinyInteger('order_type')->default(1); //订单类型 1:普通购买订单 2:定制推荐订单

            $table->tinyInteger('is_profited')->default(0); //是否已分润  0:否 1：是

            $table->integer('logistics_company_id')->nullable(); //物流公司编号
            $table->string('logistics_num')->nullable(); //物流单号


			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer_orders');
	}

}
