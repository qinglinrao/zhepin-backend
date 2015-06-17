<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCustomersGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_customers_groups', function(Blueprint $table)
		{
            $table->integer('customer_id')->unsigned();
            $table->integer('group_id')->unsigned();

            $table->index(['customer_id', 'group_id'], 'customers_groups');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer_customers_groups');
	}

}
