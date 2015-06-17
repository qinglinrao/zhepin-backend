<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImagesProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_images_products', function(Blueprint $table)
		{
            $table->integer('image_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->index(['image_id', 'product_id'], 'images_products');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_images_products');
	}

}
