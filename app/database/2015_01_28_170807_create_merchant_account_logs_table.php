<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantAccountLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('merchant_account_logs', function(Blueprint $table)
		{
			$table->increments('id');

            $table->float('money'); //操作金额
            $table->tinyInteger('trade_type')->default(1); //交易类别 0:支出  1:收入
            $table->text('log'); //日志内容
            $table->tinyInteger('operate_type')->default(1); //操作类别 1:提现 2:佣金

//            $table->integer('merchant_account_id')->unsigned();  //商家银行卡账户
            $table->integer('merchant_id')->unsigned(); //商家编号

            $table->string('bank_account_id')->nullable(); //银行卡号
            $table->string('bank_account_name')->nullable(); //银行卡开户名
            $table->string('bank_name')->nullable(); //银行名称
            $table->integer('identity_up_image_id')->default(0); //身份证正面照
            $table->integer('identity_down_image_id')->default(0); //身份证反面照
            $table->tinyInteger('status')->default(1); //账户现金操作审核状态

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
		Schema::drop('merchant_account_logs');
	}

}
