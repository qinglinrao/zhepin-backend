<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProfitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_profits', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('name');
            $table->integer('ba')->default(0); // ba分润
            $table->integer('store')->default(0); //门店分润
            $table->integer('agent')->default(0);  //代理商分润

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
		Schema::drop('product_profits');
	}

}
