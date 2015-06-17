<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAttributeValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_attribute_values', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('value');
            $table->integer('sort_order')->default(0);

            $table->integer('attribute_id')->unsigned();

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
		Schema::drop('category_attribute_values');
	}

}
