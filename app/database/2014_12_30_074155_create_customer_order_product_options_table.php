<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrderProductOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_order_product_options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('value');

			$table->integer('product_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->integer('option_id')->unsigned();
			$table->integer('option_value_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer_order_product_options');
	}

}
