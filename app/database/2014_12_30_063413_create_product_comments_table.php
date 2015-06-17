<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_comments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('author')->nullable();
            $table->text('detail')->nullable();
            $table->text('reply')->nullable();
            $table->integer('star')->unsigned();

			$table->integer('product_id')->unsigned();
			$table->integer('product_entity_id')->unsigned();
            $table->integer('customer_id')->unsigned();
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
		Schema::drop('product_comments');
	}

}
