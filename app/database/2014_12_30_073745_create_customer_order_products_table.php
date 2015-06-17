<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrderProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_order_products', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');

            $table->decimal('price', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('sku');
			$table->integer('quantity')->unsigned();

            $table->string('option_set');
            $table->string('option_set_values');
            $table->string('image_url');

			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('product_entity_id')->unsigned();

            $table->integer('shop_id')->default(0); //店铺编号
            $table->integer('shop_product_id')->default(0); //店铺产品编号


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
		Schema::drop('customer_order_products');
	}

}
