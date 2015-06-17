<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_sn_ids', function(Blueprint $table)
		{
			$table->increments('id');
		});
		DB::statement('alter table order_sn_ids AUTO_INCREMENT=1000000;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_sn_ids');
	}

}
