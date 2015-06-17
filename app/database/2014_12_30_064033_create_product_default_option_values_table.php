<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDefaultOptionValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_default_option_values', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->integer('sort_order')->default(0);

            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('option_id')->unsigned();

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
		Schema::drop('product_default_option_values');
	}

}
