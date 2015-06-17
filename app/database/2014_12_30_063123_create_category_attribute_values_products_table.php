<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAttributeValuesProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_attribute_values_products', function(Blueprint $table)
		{
            $table->integer('product_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('value_id')->unsigned()->nullable();
            $table->string('value');

            $table->index(['product_id', 'attribute_id'], 'attribute_values_products');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_attribute_values_products');
	}

}
