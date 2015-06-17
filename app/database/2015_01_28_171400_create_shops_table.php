<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shops', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('name')->default('我的店铺'); //店铺名称 默认为"我的店铺"

            $table->integer('logo_image_id')->default(0); //店铺logo
            $table->integer('cover_image_id')->default(0); //店铺封面图

            $table->string('weixin')->default(''); //店铺微信号
            $table->text('intro')->default(''); //店铺简介

            $table->integer('merchant_id')->unsigned(); //所属商家编号

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
		Schema::drop('shops');
	}

}
