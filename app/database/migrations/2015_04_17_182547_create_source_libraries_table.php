<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourceLibrariesTable extends Migration {

	/**
     * 素材库
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('source_libraries', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('title')->default('')->comment('标题'); //标题
            $table->string('author')->default('')->comment('作者'); //作者
            $table->integer('image_id')->default(0)->comment('封面图片'); //封面图片
			$table->text('summary')->nullable()->comment('摘要'); //摘要
			$table->text('content')->nullable()->comment('内容'); //内容
            $table->integer('ref_num')->default(0)->comment('素材被引用次数'); //素材被引用次数
            $table->tinyInteger('source_type')->default(0)->comment('素材类型 1:图片 2:文章'); //素材类型 1:图片 2:文章

            $table->integer('site_id')->default(0)->comment('站点编号'); //站点编号

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
		Schema::drop('source_libraries');
	}

}
