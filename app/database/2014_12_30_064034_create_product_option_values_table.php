<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_option_values', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->integer('sort_order')->default(0);

            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('option_id')->unsigned();

			$table->integer('mapping_value_id')->unsigned()->nullable(); // 关联到默认值

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
		Schema::drop('product_option_values');
	}

}
