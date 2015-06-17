<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductEntitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_entities', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('sku');
//			$table->integer('image_id')->nullable();
            $table->decimal('sale_price', 8, 2);
//			$table->decimal('par_price', 8, 2)->nullable();
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('product_id')->unsigned();

            $table->string('option_set');
            $table->string('option_set_values');
			$table->string('mapping_option_set');
//			$table->string('option_set_value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_entities');
	}

}
