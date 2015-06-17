<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('mobile');
            $table->string('encrypted_password');

//            $table->integer('sign_in_count')->unsigned()->default(0);
//            $table->timestamp('current_sign_in_at')->nullable();
//            $table->timestamp('last_sign_in_at')->nullable();
//            $table->string('current_sign_in_ip')->nullable();
//            $table->string('last_sign_in_ip')->nullable();

            $table->string('remember_token')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->tinyInteger('status')->default(1); //帐号状态 1:正常 2:冻结

            $table->integer('merchant_id')->unsigned()->default(0); //由商家分享的链接注册

            $table->float('order_total_pay',11,2)->default(0); //订单总价
            $table->integer('order_total_num')->default(0); //订单总数
            $table->float('ba_profit')->default(0); //给BA分润
            $table->float('store_profit')->default(0); //给门店分润
            $table->float('agent_profit')->default(0); //给代理商带来的总分润值
            $table->float('total_profit')->default(0); //总分润值

            $table->float('leader_profit')->default(0); //给上级带来的总分润

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
		Schema::drop('customers');
	}

}
