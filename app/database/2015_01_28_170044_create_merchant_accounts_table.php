<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('merchant_accounts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('bank_account_id')->nullable(); //银行卡号
            $table->string('bank_account_name')->nullable(); //银行卡开户名
            $table->string('bank_name')->nullable(); //银行名称
            $table->integer('identity_up_image_id')->default(0); //身份证正面照
            $table->integer('identity_down_image_id')->default(0); //身份证反面照
            $table->tinyInteger('status')->default(0); //银行卡账户审核状态 0:未通过审核 1:待审核 2:审核通过

            $table->integer('merchant_id')->unsigned(); //商家编号

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
		Schema::drop('merchant_accounts');
	}

}
