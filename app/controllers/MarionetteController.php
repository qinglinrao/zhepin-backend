<?php

class MarionetteController extends BaseController{

	public function getPage($id){

		$current_page = Page::find($id);

		if(!$current_page){
			App::abort(404);
		}

		$site = Site::find(SITE_ID);

		$industry_id = $site->industry_id;

		$themes = Theme::with('templates')
					->join('industries_themes','themes.id','=','industries_themes.theme_id')
					->where('industries_themes.industry_id',$industry_id)
					->get();


		$pages = Page::where('id',$id)->select('name','id')->get(); //todo get user id

		$page['itemList'] = $pages->toArray();

		$page['pageElement'] = json_decode($current_page->options);

		$componentDefault = $this->getComponentDefault();

		return View::make('marionette.page',compact('themes','page','current_page','componentDefault'));
	}



	public function postPage($id){
		$page = Page::find($id);

		if(!$page){
			App::abort(404);
		}

		$page_options = Input::get('page_options');
		$elements = Input::get('elements');

		$elements_sorted = '';
		if(Input::get('sort') !== 'sort=') {
			$sort = explode('&',str_replace('sort=','',Input::get('sort')));

			foreach ($sort as $k) {
				$elements_sorted[] = $elements[$k];
			}
		}
		$page->theme = $page_options['theme'];
		$page->options = json_encode($elements_sorted);

		$site_id = SITE_ID;
		if($page->save()){
			$result['state'] = 1;
			$result['url'] = "http://{$site_id}.mcshop.com.cn:8000/pages/{$page->id}/preview";
		}else{
			$result['state'] = 0;
			$result['msg'] = '保存出错';
		}

		return Response::json($result);
	}

	public function postPagePublish(){
		$id = Input::get('site_id');
		$site = Site::where('merchant_id', MERCHANT_ID)->where('id',$id)->first();
		if($site){
			$site->visible = 1;
			$site->save();
			$result['msg'] = '发布成功';
		}else{
			$result['msg'] = '发布失败';
		}

		return Response::json($result);
	}

	public function getTemplateConfig($id){

		$template = Template::with('page')->find($id);
		$elements = json_decode($template->page->options);

		return Response::json($elements);
	}


	public function getTemplate($id = null){

		if(false){ //todo 判断用户
			App::abort(404);
		}

		$industries = Industry::with('themes')->get();

		$componentDefault = $this->getComponentDefault();


		return View::make('marionette.template',compact('industries','componentDefault'));
	}



	public function postTemplate(){

		$page_options = Input::get('page_options');
		$elements = Input::get('elements');
		$sort = explode('&',str_replace('sort=','',Input::get('sort')));
		$thumb  = Input::get('thumb');
		foreach($sort as $k){
			$elements_sorted[] = $elements[$k];
		}

		$theme = Theme::where('code',$page_options['theme'])->first();

		$page = new Page;
		$page->name = $page_options['name'];
		$page->theme = $theme->code;
		$page->detail = $page_options['name'];
		$page->page_status = 'publish';
		$page->visible = 1;
		$page->options = json_encode($elements_sorted);
		$page->site_id = SITE_ID;

		if($page->save()) {

			$template = new Template;
			$template->name = $page->name;
			$template->theme = $theme->code;
			$template->theme_id = $theme->id;
			$template->free = 1;
			$template->sale_price = 0;
			$template->image_url = $thumb;
			$template->page_id = $page->id;

			if($template->save()){
				$result['state'] = 1;
				$result['msg'] = '模板创建成功';
			}else{
				$result['state'] = 0;
				$result['msg'] = '模板保存出错';
			}
		}else{
			$result['state'] = 0;
			$result['msg'] = '页面保存出错';
		}

		return Response::json($result);

	}

	public function getImageUpload(){
		return View::make('marionette.upload');
	}

	public function postImageUpload()
	{

		//upload image file
		if (Input::file()) {
			foreach (Input::file() as $key => $name) {

					$file = Input::file($key);
					$name = time(true) . '.' . $file->getClientOriginalExtension();
					$url = '/uploads/'.$key.'/' . $name;

					if (Img::make($file)->save('uploads/'.$key.'/' . $name)) {
						$result['state'] = 1;
						$result['url'] = $url;
					} else {
						$result['state'] = 0;
						$result['msg'] = '图片上传失败';
					}

			}
		} else {
			$result['state'] = 0;
			$result['msg'] = '图片不有为空';
		}

		return Response::json($result);
	}


	public function postImageResize(){
		$file_path = ltrim(Input::get('file_name'),'/');
		$w = round(Input::get('w'));
		$h = round(Input::get('h'));
		$x = round(Input::get('x'));
		$y = round(Input::get('y'));
		$file = Img::make($file_path);
		if($file){
			$file->widen(640)->crop($w,$h,$x,$y);

			if(str_contains($file_path,'/logo/')){
				$file->heighten(60);
			}

			$file->save($file_path);
			$result['state'] =1;
			$result['url'] = Input::get('file_name');
		}else{
			$result['state'] = 0;
			$result['msg'] = '获取图片失败';
		}

		return Response::json($result);
	}



	protected function getComponentDefault(){
		$ad = [
			'name'=>'图1',
			'src' => '/marionette/js/components/ads/images/slideshow.png',
			'link' => ''
		];

		$products = Product::with('thumb')->domain()->take(6)->get();

		$mainmenu = [
			['name'=>'首页','active'=>1,'visible'=>1]
		];
		$menus = ProductCategory::roots()->domain()->select('name','id')->get()->toArray();
		foreach($menus as $k => $m){
			$menus[$k]['visible'] = 1;
			$menus[$k]['active'] = 0;
		}

		$mainmenu = array_merge($mainmenu,$menus);

		$slides = [
			[
				'name' => '图1',
				'src' => '/marionette/js/components/slideshow/images/slideshow.png',
				'link' => ''
			],
			[
				'name' => '图2',
				'src' => '/marionette/js/components/slideshow/images/slideshow.png',
				'link' => ''
			],
		];

		$componentDefault = [
			'ads' => [
				'componentId' => '',
		        'componentType' => 'ads',
		        'componentName' => '广告图',
		        'titleTheme' =>'title-theme-1',
		        'hasMarginTop' => 'no',
		        'templateId' => 'tpl_1',
		        'themeId' => 'theme-1',
		        'data' => $ad
			],
			'mainmenu' => [
				'hasTitle' => 'no',
		        'componentType' => 'mainmenu',
		        'componentId' => '',
		        'componentName' => '主菜单',
		        'titleTheme' => 'title-theme-1',
				'hasMarginTop' => 'no',
		        'templateId' => 'tpl_1',
		        'themeId' => 'theme-1',
				'data' => $mainmenu
			],
			'navigator' => [
				'componentId' => '',
		        'componentType' =>  'navigator',
		        'componentName' =>  '商品橱窗',
		        'titleTheme' =>  'title-theme-1',
		        'hasBorder' =>  'no',
		        'hasMarginTop' =>  'no',
		        'templateId' =>  'tpl_1',
		        'themeId' =>  'theme-1',
				'data' => [
					['name' => '购物车', 'code' => 'shopping-cart', 'link' => '/customers/cart', 'visible' => 1],
	                ['name' => '我的订单', 'code' => 'orders', 'link' => '/customers/orders', 'visible' => 1],
	                ['name' => '我的收藏', 'code' => 'collect', 'link' => '/customers/favorites', 'visible' => 1],
	                ['name' => '个人中心', 'code' => 'profile', 'link' => '/customers/profile', 'visible' => 1],
	                ['name' => '全部分类', 'code' => 'categories', 'link' => '/products/categories', 'visible' => 1],
	                ['name' => '正品保障', 'code' => 'guarantee', 'link' => '#', 'visible' => 1],
	                ['name' => '七天退换', 'code' => 'returns', 'link' => '#', 'visible' => 1],
	                ['name' => '免费维护', 'code' => 'maintain', 'link' => '#', 'visible' => 1],
	                ['name' => '全场包邮', 'code' => 'postage', 'link' => '#', 'visible' => 1],
	                ['name' => '闪电发货', 'code' => 'deliver', 'link' => '#', 'visible' => 1],
	                ['name' => '货到付款', 'code' => 'cod', 'link' => '#', 'visible' => 1],
	                ['name' => '客户服务', 'code' => 'service', 'link' => '#', 'visible' => 1],
				]
			],
			'products' => [
				'componentId' => '',
                'componentType' => 'products',
                'hasTitle' => 'yes',
                'componentName' => '商品橱窗',
                'titleTheme' => 'title-theme-1',
                'hasBorder' => 'no',
                'hasMarginTop' => 'no',
                'dataLimit' => '2',
                'templateId' => 'tpl_1',
                'themeId' => 'theme-1',
				'data' => $products
			],
			'slideshow' => [
				'componentId' => '',
                'componentName' => '幻灯片',
                'componentType' => 'slideshow',
                'rtl' => 0,
                'hasBorder' => 'no',
                'autoplayTimeout' => 3000,
                'titleTheme' => 'title-theme-1',
                'hasMarginTop' => 'no',
                'templateId' => 'tpl_1',
                'themeId' => 'theme-1',
				'data' => $slides
			]
		];

		return $componentDefault;
	}



	public function getProductsSelect(){

		if(Input::get('pIds')){
			$pIds = explode(',',Input::get('pIds'));
			Session::put('pIds',$pIds);
		}else{
			$pIds=Session::has('pIds') ? Session::get('pIds') : [];
		}

		$categories = ProductCategory::roots()->with('children')->get();
		$catArray = [0=>'全部'];
		foreach ($categories as $c){
			$catArray[$c->name] = $c->children->lists('name','id');
		}

		$products = Product::with('category','thumb')->where('site_id', SITE_ID);

		if(Input::get('sku') != ''){
			$products = $products->where('sku','like','%'.Input::get('sku').'%');
		}
		if(Input::get('name') != ''){
			$products = $products->where('name','like','%'.Input::get('name').'%');
		}
		if(Input::get('category_id') != 0){
			$products = $products->where('category_id',Input::get('category_id'));
		}

		$products = $products->paginate(10);


		return View::make('marionette.products',compact('products','catArray','pIds'));
	}


	public function postProductsSelectAdd(){

		$pIds=Session::has('pIds') ? Session::get('pIds') : [];

		$newIds = array_diff(Input::get('pIds'),$pIds);

		if(!empty($newIds)){
			$pIds = array_merge($pIds,$newIds);

			Session::put('pIds',$pIds);

			$products = Product::with('thumb')->find(Input::get('pIds'));

			$html = '';
			foreach($products as $p){
				$html .= '<li class="product clearfix" data-id="'.$p->id.'" title="可拖动进行排序">'.
					'<div class="delete-item"><img src="/marionette/images/delete_item.png"/></div>'.
					'<img class="prod-img" src="'.$p->thumb->url.'"/>'.
					'<div class="prod-name" data-saleprice="'.$p->sale_price.'" data-parprice="'.$p->par_price.'"
		                data-sale="'.$p->sale_count.'">'.$p->name.'</div>'.
					'<div class="prod-price">￥'.$p->sale_price.'</div>'.
					'</li>';
			}
			$result['state'] = 1;
			$result['html'] = $html;
		}else{
			$result['state'] = 0;
		}

		return Response::json($result);
	}

}