<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionsProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_options_products', function(Blueprint $table)
		{
            $table->integer('product_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->integer('option_value_id')->unsigned();

            $table->index(['product_id', 'option_value_id'], 'options_products');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_options_products');
	}

}
