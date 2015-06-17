<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthCodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auth_codes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('mobile')->nullable(); //手机号
			$table->string('email')->nullable(); //邮箱
			$table->string('code'); //验证码
			$table->string('state');//验证码发送状态
			$table->string('type'); //email or mobile
            $table->dateTime('expired_at'); //过期时间
            $table->integer('effective_minutes')->default(15); //有效分钟数
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
		Schema::drop('auth_codes');
	}

}
