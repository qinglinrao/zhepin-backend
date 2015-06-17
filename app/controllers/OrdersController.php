<?php

class OrdersController extends \BaseController {

    # ANY /orders
    /**
     * 订单列表
     * @return mixed
     */
    public function index(){
        $query = trim(Input::get('query')); //输入的订单号或商品名称
        $address_name = Input::get('address_name'); //收货人名称
        $telephone = Input::get('telephone'); //订单地址手机号
        $buy_time = Input::get('buy_time'); //购买时间数组
        $status = Input::get('status'); //订单状态
        $stock = Input::get('stock'); //产品库存量
        $region = Input::get('region'); //订单收货地区
        $orders = CustomerOrder::with('orderProducts.productEntity','orderProducts.product.thumb','orderAddress','customer','histories');
        //订单状态查询
        isset($status)&& !empty($status) ? $orders = $orders->whereIn('status_id',get_order_status_group($status)) : '';
        //搜索内容模糊查询(产品名称、订单编号、收货人名称)
        isset($query) && !empty($query) ? $orders = $orders->whereHas('orderProducts', function($q) use ($query) {
                $q->where('name', 'like', '%'.$query.'%');
            })->orWhere('order_sn','like','%'.$query.'%') : '';
        isset($address_name) && !empty($address_name) ? $orders = $orders->whereHas('orderAddress', function($q) use ($address_name) {
            $q->where('name', 'like', '%'.$address_name.'%');
        }) : '' ;

        //订单地址手机号和订单地区查询
        if($region['city'] || $region['province'] || $telephone){
            $orders = $orders->whereHas('orderAddress', function($q) use ($telephone,$region) {
                isset($telephone) && !empty($telephone) ? $q->where('telephone', 'like', '%'.$telephone.'%')->orWhere('mobile', 'like', '%'.$telephone.'%') : '';
                isset($region) && !empty($region) ? $q->whereHas('region',function($q) use($region){
                    if(isset($region['city']) && !empty($region['city'])){
                        $q->where('id',$region['city'])->orWhere('city_id',$region['city']);
                    }else if(isset($region['province']) && !empty($region['province'])){
                        $q->where('id',$region['province'])->orWhere('province_id',$region['province']);
                    }
                }) : '';
            }) ;
        }

        //产品库存量查询
        isset($stock) && !empty($stock) ? $orders = $orders->whereHas('orderProducts', function($q) use ($stock) {
            $q->whereHas('productEntity',function($q) use ($stock) {
                $q->whereBetween('stock',get_stock_array()[$stock]);
            });

        }) : '' ;
        //订单下单时间查询
        isset($buy_time) && !empty($buy_time) ? $orders = $orders->where(function($q) use($buy_time){
            if(isset($buy_time['from']) && !empty($buy_time['from']))
                $q->where('created_at','>=',$buy_time['from']);
            if(isset($buy_time['to']) && !empty($buy_time['to']))
                $q->where('created_at','<=',$buy_time['to']);

        }) : '';

        $orders = $orders->orderBy('updated_at','desc')->paginate(5);

        return View::make('orders.index')
                     ->with('orders',$orders)
                     ->withInput(Input::all())
                     ->with('query',$query)
                     ->with('address_name',$address_name)
                     ->with('telephone',$telephone)
                     ->with('status',$status)
                     ->with('buy_time',$buy_time)
                     ->with('stock',$stock)
                     ->with('region',$region);
    }

    # GET /order/{id}
    public function detail($order_id){

        $order = CustomerOrder::with('logistics','orderProducts.productEntity','orderProducts.product','orderAddress','customer')->where('id',$order_id)->first();
        return View::make('orders.detail')
                     ->with('order',$order);
    }

    # GET /order/logistics
    public function logistics(){

        return View::make('orders.logistics');
    }

    # GET /order/inform_template
    public function informTemplate(){
        return View::make('orders.inform_template');
    }

    # GET /order/{id}/close
    public function closeOrder($order_id){
        $order = CustomerOrder::where('id',$order_id)->first();
        if($order){
            $order->status_id = 10;
            if($order->save()){
                return Redirect::route('orders.index');
            }else{
                return Redirect::route('orders.index')->withErrors(array('system.error' => '系统错误！'));
            }
        }else{
            return Redirect::route('orders.index')->withErrors(array('order.not_found' => '订单不存在！'));

        }
    }

    public function postDelieverOrder(){

        $data = array(
            'order_id' => Input::get('order_id'),
            'logistics_company_id' => Input::get('logistics_company_id'),
            'logistics_num' => Input::get('logistics_num')
        );
        $rules = array(
            'order_id' =>'required',
            'logistics_company_id' => 'required',
            'logistics_num' => 'required'
        );
        $messages = array(
            'order_id.required' => '请求错误!',
            'logistics_company_id.required' => '请选择物流公司!',
            'logistics_num.required' => '请填写物流单号!'
        );
        $v = Validator::make($data, $rules, $messages);
        if ($v->fails()) {
            return Redirect::back()->withInput()->withErrors(array('error'=>$v->messages()->first()));
        }else{
            $order = CustomerOrder::where('id',$data['order_id'])->first();
            $logistics_company = LogisticsCompany::where('id',$data['logistics_company_id'])->first();
            if($order && $logistics_company){
                if($order->status_id == 2){
                    $order->status_id = 3;
                    $order->logistics_company_id = $data['logistics_company_id'];
                    $order->logistics_num = $data['logistics_num'];
                    if($order->save()){
                        return Redirect::back();
                    }else{
                        return Redirect::back()->withErrors(array('error'=>'系统错误!发货失败!'));
                    }
                }
        }else{
                App::abort(404);
            }
        }
    }

    public function changeOrderStatus($order_id,$status){

        $order = CustomerOrder::where('id',$order_id)->first();
        if($order){
            if(confirm_order_action($order->status_id,$status)){
                $order->status_id = $status;
                if($order->save()){
                    return Redirect::back();
                }
            }
        }else{
            return Redirect::back()->withErrors(array('error'=>'系统错误!'));
        }

    }

}
