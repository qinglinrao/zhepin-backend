<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//解决分页链接不带参数的bug
View::composer(Paginator::getViewName(), function($view) {
    $query = array_except( Input::query(), Paginator::getPageName() );
    $view->paginator->appends($query);
});



Route::get('login', ['as'=>'admin.login', 'uses'=>'AdminController@getLogin']);
Route::post('login', ['as'=>'admin.login', 'uses'=>'AdminController@postLogin']);
//Route::get('register', ['as'=>'merchants.register', 'uses'=>'MerchantsController@getRegister']);
//Route::post('register', ['as'=>'merchants.register', 'uses'=>'MerchantsController@postRegister']);
Route::post('authcode', ['as'=>'authcode','uses'=>'MerchantsController@postAuthCode']);
Route::get('validate_code', ['as'=>'validate_code','uses'=>'AdminController@getValidateCodeImage']);
Route::get('logout', ['as'=>'logout', 'uses'=>'AdminController@getLogout']);


Route::resource('categories', 'ProductCategoriesController');
Route::resource('attributes', 'CategoryAttributesController');
Route::resource('brands', 'ProductBrandsController');

Route::resource('options', 'ProductOptionsController');

//Route::group(['before'=>'guest'], function() {
//    Route::get('login', ['as'=>'merchants.login', 'uses'=>'MerchantsController@getLogin']);
//    Route::post('login', ['as'=>'merchants.login', 'uses'=>'MerchantsController@postLogin']);
//    Route::get('register', ['as'=>'merchants.register', 'uses'=>'MerchantsController@getRegister']);
//    Route::post('register', ['as'=>'merchants.register', 'uses'=>'MerchantsController@postRegister']);
//    Route::post('authcode', ['as'=>'authcode','uses'=>'MerchantsController@postAuthCode']);
//    Route::get('validate_code', ['as'=>'validate_code','uses'=>'MerchantsController@getValidateCodeImage']);
//    Route::get('logout', ['as'=>'logout', 'uses'=>'MerchantsController@getLogout']);
//});



Route::group(['before' => 'auth'],function() {
//    // 定义常量
//    if($merchant = Auth::user()) {
//        define('MERCHANT_ID', $merchant->id);
//        define('SITE_ID', $merchant->sites[0]->id);
//    } else {
//        define('MERCHANT_ID', 1);
//        define('SITE_ID', 1);
//    }

    Route::get('/', function()
    {
        return Redirect::route('orders.index');
    });

    Route::get('products/{status}', ['as'=>'products.status', 'uses'=>'ProductsController@index'])->where('status', '(online|offline)');
    Route::get('products/{products}/copy', ['as'=>'products.copy', 'uses'=>'ProductsController@copy']);
    Route::resource('products', 'ProductsController');

    Route::resource('categories', 'ProductCategoriesController');
    Route::resource('attributes', 'CategoryAttributesController');
    Route::resource('brands', 'ProductBrandsController');

    Route::resource('options', 'ProductOptionsController');

    Route::resource('attribute-sets', 'AttributeSetsController');
    Route::resource('attributes', 'AttributesController');

    Route::resource('product-services', 'ProductServicesController');

    Route::post('folders/products', ['as' => 'folders/products', 'user' => 'ProductFoldersController@products']);
    Route::resource('folders', 'ProductFoldersController');

    Route::any('orders', ['as' => 'orders.index', 'uses' => 'OrdersController@index']);
    Route::get('order/{id}', ['as' => 'orders.detail', 'uses' => 'OrdersController@detail'])->where('id', '\d+');
    Route::get('order/{id}/close', ['as' => 'orders.close', 'uses' => 'OrdersController@closeOrder'])->where('id', '\d+');
    Route::get('order/logistics', ['as' => 'orders.logistics', 'uses' => 'OrdersController@logistics']);
    Route::get('order/inform_template', ['as' => 'orders.inform_template', 'uses' => 'OrdersController@informTemplate']);
    Route::post('order/deliever', ['as' => 'orders.deliever', 'uses' => 'OrdersController@postDelieverOrder']);
    Route::get('order/{order_id}/status/{status}', ['as' => 'orders.change_status', 'uses' => 'OrdersController@changeOrderStatus']);



    Route::group([ 'prefix'=>'other'], function () {
        Route::get('banners', ['as' => 'other.banners', 'uses' => 'OtherController@getBanners']);
        Route::get('ads', ['as' => 'other.ads', 'uses' => 'OtherController@getAds']);
        Route::post('update_banner', ['as' => 'other.update_banner', 'uses' => 'OtherController@postUpdateBanner']);
        Route::get('export_excel', ['as' => 'other.export_excel', 'uses' => 'OtherController@getExportOrderExcel']);
//        Route::resource('options',  'ApiProductOptionsController');
    });


    Route::api(['version'=>'v1', 'prefix'=>'api'], function () {
        Route::resource('products', 'ApiProductsController');
        Route::resource('options',  'ApiProductOptionsController');
    });

    Route::resource('customers', 'CustomersController');
    Route::post('customers/batch_delete',['as'=>'customers.batch_delete','uses'=>'CustomersController@postBatchDelete']);
    Route::get('customer-levels/', ['as' => 'customer-levels.index', 'uses' => 'CustomerLevelsController@index']);
    Route::get('customer/{id}/detail', ['as' => 'customer.detail', 'uses' => 'CustomersController@show']);


    Route::resource('site-images', 'ImagesController');
    Route::resource('labels', 'LabelsController');


    Route::get('/', function()
    {

        //return View::make('hello');
    });

    Route::get('system_config/pay_setting', ['as'=>'pay_setting', 'uses'=>'SystemConfigController@getPaySetting']);
    Route::post('system_config/pay_setting', ['as'=>'pay_setting', 'uses'=>'SystemConfigController@postPaySetting']);

    Route::controller('ajax', 'AjaxController');

    Route::api(['version'=>'v1', 'prefix'=>'api'], function () {
        Route::get('products/{id}/options', ['as'=>'products.options', 'uses'=>'ApiProductsController@options'])->where('id','\d+');
        Route::resource('products', 'ApiProductsController');

        Route::resource('options',  'ApiProductOptionsController');
    });


    Route::get('system_config/pay_setting', ['as'=>'pay_setting', 'uses'=>'SystemConfigController@getPaySetting']);
    Route::post('system_config/pay_setting', ['as'=>'pay_setting', 'uses'=>'SystemConfigController@postPaySetting']);

    Route::post('pages/publish',['as'=>'marionette.pages.publish','uses'=>'MarionetteController@postPagePublish']);

    Route::get('pages/{id}',['as'=>'marionette.pages','before'=>'just-chrome','uses'=>'MarionetteController@getPage']);
    Route::post('pages/{id}',['as'=>'marionette.pages','uses'=>'MarionetteController@postPage']);

    Route::get('templates/{id?}',['as'=>'marionette.templates','before'=>'just-chrome','uses'=>'MarionetteController@getTemplate']);
    Route::get('templates/{id}/config',['as'=>'marionette.templates.config',
        'uses'=>'MarionetteController@getTemplateConfig']);
    Route::post('templates',['as'=>'marionette.templates','uses'=>'MarionetteController@postTemplate']);

    Route::get('image-upload',['as'=>'image.upload','uses'=>'MarionetteController@getImageUpload']);
    Route::post('image-upload',['as'=>'image.upload','uses'=>'MarionetteController@postImageUpload']);
    Route::post('image-resize',['as'=>'image.resize','uses'=>'MarionetteController@postImageResize']);

    Route::get('products-select',['as'=>'products.select', 'uses' => 'MarionetteController@getProductsSelect']);
    Route::post('products-select/add',['as'=>'products.select.add', 'uses' =>
        'MarionetteController@postProductsSelectAdd']);


    Route::get('profit',['as'=>'profit.index','uses'=>'ProfitController@getIndex']);
    Route::get('profit/{id}/del',['as'=>'profit.del','uses'=>'ProfitController@getDelete'])->where('id','\d+');
    Route::get('profit/{type}/list',['as'=>'profit.merchants','uses'=>'MerchantsController@getMerchants'])->where('type','\d+');

    Route::get('merchants/{id}/change_status/{status}',['as'=>'merchants.change_status','uses'=>'MerchantsController@getChangeStatus'])->where('id','\d+')->where('status','\d+');
    Route::get('merchants/{id}/delete',['as'=>'merchants.delete','uses'=>'MerchantsController@getDelete'])->where('id','\d+');
    Route::get('merchants/{id}/detail',['as'=>'merchants.detail','uses'=>'MerchantsController@getDetail'])->where('id','\d+');
    Route::post('merchants/batch_delete',['as'=>'merchants.batch_delete','uses'=>'MerchantsController@postBatchDelete']);
    Route::get('merchants/add',['as'=>'merchants.add','uses'=>'MerchantsController@getAdd']);
    Route::post('merchants/create',['as'=>'merchants.create','uses'=>'MerchantsController@postCreate']);
    Route::get('merchants/{id}/account_log',['as'=>'merchants.account_log','uses'=>'MerchantsController@getAccountLog'])->where('id','\d+');
    Route::get('merchants/account_idcard_check',['as'=>'merchants.account_idcard_check','uses'=>'MerchantsController@getShowIdentityCard']);
    Route::get('merchants/{id}/account_money_clear',['as'=>'merchants.account_money_clear','uses'=>'MerchantsController@dealCustomerProfitApply']);
//    Route::get('merchants/{id}/change_account_status/{status}',['as'=>'merchants.change_account_status','uses'=>'MerchantsController@getChangeAccountStatus'])->where('id','\d+')->where('status','\d+');


    //素材库
    Route::group(['prefix' => 'sources'], function () {
        Route::get('list', ['as' => 'sources.list', 'uses' => 'SourceLibraryController@getSourceList']);
        Route::get('add_article', ['as' => 'sources.add_article', 'uses' => 'SourceLibraryController@getAddArticle']);
        Route::get('edit_source/{id}', ['as' => 'sources.edit_source', 'uses' => 'SourceLibraryController@getEditSource'])->where('id', '\d+');
        Route::get('delete_source/{id}', ['as' => 'sources.delete_source', 'uses' => 'SourceLibraryController@getDeleteSource'])->where('id', '\d+');
        Route::post('update_source/{id}', ['as' => 'sources.update_source', 'uses' => 'SourceLibraryController@postUpdateSource'])->where('id', '\d+');
        Route::post('save_source', ['as' => 'sources.save_source', 'uses' => 'SourceLibraryController@postSaveSource']);
        Route::post('add_picture', ['as' => 'sources.add_picture', 'uses' => 'SourceLibraryController@postAddPicture']);
    });


    Route::get('account_log',['as'=>'account_log','uses'=>'AccountLogController@getList']);
    Route::get('account_log/{id}/detail',['as'=>'account_log_detail','uses'=>'AccountLogController@getLogDetail'])->where('id','\d+');
});


