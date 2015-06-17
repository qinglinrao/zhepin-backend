<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('url');

            $table->string('file_path');
            $table->string('file_type');
            $table->integer('file_size');

            $table->boolean('used')->default(false);
            $table->boolean('common')->default(false);

            $table->integer('use_count')->default(0);
            $table->integer('sort_order')->default(0);

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
		Schema::drop('images');
	}

}
