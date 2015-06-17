<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('email')->nullable(); // 邮箱地址
            $table->string('mobile')->nullable(); //手机号码
            $table->string('password'); //密码
            $table->string('name')->default('管理员'); //真实姓名
            $table->string('emp_no')->default(''); //员工编号
            $table->string('remember_token')->nullable();

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
		Schema::drop('admins');
	}

}
