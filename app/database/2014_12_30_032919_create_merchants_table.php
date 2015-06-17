<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('merchants', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('remember_token');
            $table->string('username')->nullable(); //昵称
            $table->string('email')->nullable(); //邮箱地址
            $table->string('mobile'); //手机号码
            $table->string('encrypted_password'); //密码
            $table->integer('image_id')->default(0); //商家头像

            $table->string('real_name')->nullable(); //真实姓名 (负责人)
            $table->string('identity_num')->nullable(); //身份证号
            $table->boolean('sex')->default(true); //性别
            $table->integer('age')->default(0); //年龄
            $table->integer('region_id')->default(0); //地区

            $table->tinyInteger('merchant_grade')->default(3); //商家等级  1：代理商 2：门店 3：BA
            $table->integer('customer_num')->default(0); //客户数量 (自己店铺的)
            $table->integer('order_num')->default(0); //总销售订单数（自己店铺的）
            $table->float('total_pay')->default(0); //订单总销售额 (自己店铺的)

            $table->float('follower_profit')->default(0); // 下线带来的总分润
            $table->float('shop_profit')->default(0); //自己店铺所得分润
            $table->float('total_profit')->default(0); //账户所得总分润

            $table->float('leader_profit')->default(0); //给上线带来的总利润

            $table->float('money')->default(0); //账户余额

            $table->tinyInteger('status')->default(1); //入驻审核状态(商家状态) 0：审核不通过 1:待审核 2:审核通过 3:被冻结
            $table->integer('follower_num')->default(0); //下线个数
            $table->integer('leader_id'); //上线商家编号

			$table->timestamps();

            $table->tinyInteger('visible')->default(1);

            $table->string('company')->default(''); //公司名称
            $table->string('shop_address')->default(''); //店铺地址
            $table->string('responsible_area')->default(''); //负责区域

		});

        DB::statement('alter table merchants AUTO_INCREMENT=10000;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('merchants');
	}

}
