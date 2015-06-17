<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$tables = [
//             'product_categories',
//			'product_options', 'product_default_option_values',
//			'products','product_services',
//			'category_attributes', 'category_attribute_sets', 'category_attribute_values',
//			 'images',
//			'customers','customer_details',
//			'customer_orders',
//			'customer_order_products',
//			'product_entities',
//			'customer_order_addresses',
//			'customer_levels',
//			'customer_groups','customer_customers_groups',
//			'customer_order_histories',
//            'admins','roles','admin_roles',
//            'merchants',
//            'shops','shop_products',
            'logistics_companies'
		];

		foreach ($tables as $table)
		{
			DB::table($table)->truncate();
		}

//		define('PRODUCT_NUMBER', 100);
//		define('ORDER_NUMBER', 50);
//		define('PRODUCT_FOLDER_NUMBER', 20);
//
//		$this->call('ImageTableSeeder');
//
//		$this->call('ProductOptionTableSeeder');
//		$this->call('ProductCategoryTableSeeder');
//		$this->call('ProductTableSeeder');
//		$this->call('ProductEntityTableSeeder');
//		$this->call('ProductServicesTableSeeder');
//
//		$this->call('AttributeSetsTableSeeder');
//		$this->call('AttributesTableSeeder');
//
//		$this->call('CustomersTableSeeder');
//        $this->call('CustomerDetailTableSeeder');
//		$this->call('CustomerOrderTableSeeder');
//		$this->call('CustomerOrderProductTableSeeder');
//		$this->call('CustomerOrderAddressTableSeeder');
//		$this->call('CustomerLevelTableSeeder');
//		$this->call('CustomerGroupTableSeeder');
//		$this->call('CustomerCustomersGroupTableSeeder');
//		$this->call('CustomerOrderHistoryTableSeeder');
//
//
//        $this->call('MerchantTableSeeder');
//        $this->call('MerchantAccountTableSeeder');
//        $this->call('MerchantAccountLogTableSeeder');
//
//        $this->call('ShopTableSeeder');
//        $this->call('ShopProductTableSeeder');
//
//        $this->call('AdminTableSeeder');
//        $this->call('RoleTableSeeder');
//        $this->call('AdminRoleTableSeeder');
        $this->call('LogisticsCompanyTableSeeder');

	}

}
