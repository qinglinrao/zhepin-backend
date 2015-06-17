<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAttributesAttributeSetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_attributes_attribute_sets', function(Blueprint $table)
		{
            $table->integer('attribute_id')->unsigned();
            $table->integer('attribute_set_id')->unsigned();

            $table->index(['attribute_id', 'attribute_set_id'], 'attributes_attribute_sets');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_attributes_attribute_sets');
	}

}
