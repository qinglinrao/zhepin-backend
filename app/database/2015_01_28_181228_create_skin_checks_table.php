<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinChecksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skin_checks', function(Blueprint $table)
		{
			$table->increments('id');

            $table->tinyInteger('position')->default(1); //检测部位 1：手 2：脸 3：眼睛
            $table->float('moisture')->default(0); //水份
            $table->float('oil')->default(0); //油份
            $table->float('result_percent')->default(0); //综合指数 百分比
            $table->string('result_value'); //综合指数值

            $table->integer('customer_id')->unsigned(); //顾客编号

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
		Schema::drop('skin_checks');
	}

}
