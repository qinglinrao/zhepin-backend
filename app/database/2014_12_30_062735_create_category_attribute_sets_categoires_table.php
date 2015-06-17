<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAttributeSetsCategoiresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_attribute_sets_categories', function(Blueprint $table)
		{
            $table->integer('category_id')->unsigned();
            $table->integer('attribute_set_id')->unsigned();

            $table->index(['category_id', 'attribute_set_id'], 'attribute_sets_categories');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_attribute_sets_categories');
	}

}
