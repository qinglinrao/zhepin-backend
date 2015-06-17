<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatMerchantResponsibleAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('merchant_responsible_areas', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('merchant_id')->default(0); //商家编号
            $table->integer('region_id')->default(0); //地区编号
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
		Schema::drop('merchant_responsible_areas');
	}

}
