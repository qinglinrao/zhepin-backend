<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrderHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_order_histories', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('comment');
			$table->integer('order_id');
			$table->integer('status_id');
			$table->string('status_name');

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
		Schema::drop('customer_order_histories');
	}

}
