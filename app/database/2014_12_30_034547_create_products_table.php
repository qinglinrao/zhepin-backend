<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('title')->default(''); //副标题
            $table->text('detail');
            $table->string('note')->nullable();
            $table->string('sku')->nullable();
            $table->string('type')->default('entity'); //商品类型

            $table->decimal('par_price', 8, 2);
            $table->decimal('sale_price', 8, 2);

            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->default(0);
            $table->integer('brand_id')->unsigned()->nullable();

            $table->boolean('enabled')->default(true);
            $table->boolean('visible')->default(true); // 1:上架  0:下架

            $table->timestamp('published_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('created_by')->unsigned()->default(0);
            $table->integer('updated_by')->unsigned()->default(0);
            $table->integer('sale_count')->unsigned()->default(0);
            $table->integer('visit_count')->unsigned()->default(0);
            $table->integer('collection_count')->unsigned()->default(0);
            $table->integer('comment_count')->unsigned()->default(0);
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('invoice')->unsigned()->default(0);
            $table->integer('counting_method')->unsigned()->default(0);
            $table->integer('logistics')->unsigned()->default(0);

            $table->text('attribute_values')->nullable();

            $table->integer('profit_id')->default(0);
            $table->float('profit')->default(0); //可分润值
            $table->tinyInteger('display_type')->default(1); //展示类型 1：只在后台显示 0:可在前台显示 （定制与非定制）

            $table->integer('ba_profit')->default(0); // ba分润
            $table->integer('store_profit')->default(0); //门店分润
            $table->integer('agent_profit')->default(0);  //代理商分润

            $table->tinyInteger('use_position')->default(1); //使用部位 1:手 2:脸 3:眼睛
            $table->tinyInteger('skin_status')->default(1); //适用肌肤状态 1:干燥 2:正常 3:湿润

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
		Schema::drop('products');
	}

}
