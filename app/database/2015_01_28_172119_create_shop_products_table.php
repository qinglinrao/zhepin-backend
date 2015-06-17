<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_products', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('shop_id')->unsigned(); //店铺编号
            $table->integer('product_id')->unsigned(); //产品编号
            $table->integer('merchant_id')->unsigned(); //商家编号

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
		Schema::drop('shop_products');
	}

}
