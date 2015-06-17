<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_attributes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('note');
            $table->string('input_type');
            $table->string('frontend_label');
            $table->string('default_value');
            $table->boolean('required')->default(true);

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
		Schema::drop('category_attributes');
	}

}
