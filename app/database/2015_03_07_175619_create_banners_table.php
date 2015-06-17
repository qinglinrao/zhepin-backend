<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banners', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('url')->default('#'); //banner链接
            $table->integer('image_id');
            $table->tinyInteger('visible')->default(1); // 1:显示 0：隐藏
            $table->integer('type'); //1:轮播图 2:广告
            $table->string('title');
			$table->timestamps();
            $table->integer('product_id')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('banners');
	}

}
