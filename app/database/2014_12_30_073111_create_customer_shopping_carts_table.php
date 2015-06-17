<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerShoppingCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_shopping_carts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('quantity')->unsigned();

            $table->integer('product_entity_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('customer_id')->unsigned();

            $table->integer('shop_id')->unsigned();


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
		Schema::drop('customer_shopping_carts');
	}

}
