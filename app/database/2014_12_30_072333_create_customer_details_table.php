<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_details', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('username')->nullable(); //昵称
            $table->integer('region_id')->default(0); //所在地区
            $table->integer('skin_type_id')->default(0); //肤质编号
            $table->date('birthday')->nullable(); //年龄
            $table->boolean('sex')->default(false); //性别 true:男 false:女
            $table->integer('image_id')->default(0); //头像编号

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
		Schema::drop('customer_details');
	}

}
