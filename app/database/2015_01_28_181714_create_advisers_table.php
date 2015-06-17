<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvisersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advisers', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('mobile'); //手机号
            $table->string('encrypted_password'); //密码
            $table->string('real_name'); //真实姓名
            $table->string('identity_num'); //身份证号
            $table->string('username')->nullable(); //昵称
            $table->boolean('sex')->default(false); //性别
            $table->string('professional')->nullable(); //职称 //类似于“优理氏专业美肤专家”
            $table->text('intro')->nullable(); //简介
            $table->text('achievement')->nullable(); //成就
            $table->text('skilled')->nullable(); //擅长
            $table->integer('total_asked')->default(0); //总咨询人数
            $table->tinyInteger('valuation_level')->default(1); //总评级 1-5星
            $table->integer('image_id')->default(0); //头像编号

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
		Schema::drop('advisors');
	}

}
