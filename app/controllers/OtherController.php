<?php

class OtherController extends \BaseController {

   public function getBanners(){

       $banners = Banner::ofType(1)->get();

       return View::make('other.banner',compact('banners'));
   }

    public function getAds(){

        $banners = Banner::ofType(2)->get();

        return View::make('other.ad',compact('banners'));
    }

    public function postUpdateBanner(){

        $url = Input::get('url');
        $banner_id = Input::get('banner_id');

        $image_file = Input::file('image');
        $banner = Banner::where('id',$banner_id)->first();
        if($banner){
            $configure = array(
                'attr'=>'image_id',
                'folder'=>'Banners',
                'relation_image_name'=>'image',
                'width'=>640,
                'height'=>280
            );
            try{
                if(Input::hasFile('image'))
                    $image = $this->uploadImage($image_file,$configure,true,true,$banner);
                $banner->url = $url;
                if(Input::has('title')){
                    $banner->title = Input::get('title');
                }
                $banner->save();
                return Redirect::back();
            }catch (Exception $e){
                return Redirect::back();
            }

        }else{
            return Redirect::back();
        }

    }


    //导出订单Excel
    public function  getExportOrderExcel(){


        $sheet_name = date('YmdHis', time()).'优理氏订单报表';
        Excel::create($sheet_name, function($excel) use($sheet_name)  {
            $excel->sheet($sheet_name, function($sheet)  {
                $orders = CustomerOrder::with('customer','orderAddress','logistics','orderProducts.shop')->get();
                $row_num = 1;

                $title = ['外部订单号','单据日期','买家','联系人','联系电话','快递公司','快递单号','送货地址','创建时间','交货日期','仓库',
//                        '商品编码','颜色分类','尺码',

                    '商品编码','购买属性','商品属性条','商品单价','商品数量','商品折扣','运费金额','商品单位','商品描述',
                    '商品税率','是否赠品','商品条形码','网店名称','网店账户',

                    '卖家留言','买家留言','买家省份','买家城市','买家地区','买家邮编','买家单位','传真','买家区号',
                    '标签内容','标签色','部门','客服人员','摘要','结算方式','币种','汇率','发票类型','结算帐户','卖家名称','卖家地址','业务员'

                ];
                $sheet->row($row_num++, $title);


                foreach($orders as $order){

                    $customer = $order->customer; //买家
                    $order_address = $order->orderAddress; //送货地址
                    $logistics = $order->logistics; //快递公司

                    $order_products  = $order->orderProducts;

                    if($order_products->count()){

                        $sheet->setMergeColumn(array(
                            'columns' => array('A','B','C','D','E','F','G','H','I','J','K'),
                            'rows' => array(
                                array($row_num,$row_num+$order->orderProducts->count()-1)
                            )
                        ));

                        $sheet->setMergeColumn(array(
                            'columns' => array('AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV'),
                            'rows' => array(
                                array($row_num,$row_num+$order->orderProducts->count()-1)
                            )
                        ));

                        $sheet->setWidth(array(
                            'A'     =>  20,
                            'B'     =>  20,
                            'C'     =>  10,
                            'D'     =>  10,
                            'E'     =>  30,
                            'F'     =>  15,
                            'G'     =>  15,
                            'H'     =>  40,
                            'I'     =>  15,
                            'J'     =>  10,
                            'K'     =>  10,
                            'L'     =>  10,
                            'M'     =>  30,
                            'N'     =>  10,
                            'O'     =>  10,
                            'P'     =>  10,
                            'Q'     =>  10,
                            'R'     =>  10,
                            'S'     =>  10,
                            'T'     =>  55,
                            'U'     =>  10,
                            'V'     =>  10,
                            'W'     =>  10,
                            'X'     =>  10,
                            'Y'     =>  20,
                            'Z'     =>  10,
                            'AA'     =>  10,
                            'AB'     =>  10,
                            'AC'     =>  10,
                            'AD'     =>  10,
                            'AE'     =>  10,
                            'AF'     =>  10,
                            'AG'     =>  10,
                            'AH'     =>  10,
                            'AI'     =>  10,
                            'AJ'     =>  10,
                            'AK'     =>  10,
                            'AL'     =>  10,
                            'AM'     =>  10,
                            'AN'     =>  10,
                            'AO'     =>  10,
                            'AP'     =>  10,
                            'AQ'     =>  10,
                            'AR'     =>  10,
                            'AS'     =>  10,
                            'AT'     =>  10,
                            'AU'     =>  10,
                        ));


                        foreach($order_products as $order_product){


                            $data = [];

                            array_push($data,$order->order_sn); //外部订单号
                            array_push($data,date('Y-m-d H:i:s', time())); //单据日期
                            array_push($data,$customer->username); //买家
                            array_push($data,$order_address->name); //联系人
                            array_push($data,$order_address->mobile); //联系电话
                            array_push($data,$logistics->name); //快递公司
                            array_push($data,$order->logistics_num); //快递单号
                            array_push($data,$order_address->alias); //送货地址
                            array_push($data,$order->created_at->format('Y-m-d H:i')); //创建时间
                            array_push($data,''); //交货日期
                            array_push($data,''); //仓库


                            //---------------------11-----A--K-------------


//                        //---------------------Single Column--------------------
                            array_push($data,$order_product->sku); //商品编码
    //                      array_push($data,$order->created_at); //颜色分类
    //                      array_push($data,$order->created_at); //尺码
                            array_push($data,$order_product->option_set_values); //购买属性
                            array_push($data,''); //商品属性条
                            array_push($data,$order_product->price); //商品单价
                            array_push($data,$order_product->quantity); //商品数量
                            array_push($data,''); //商品折扣
                            array_push($data,''); //运费金额
                            array_push($data,'件'); //商品单位
                            array_push($data,$order_product->name); //商品描述


                            //-------------------9----------------------


                            array_push($data,''); //商品税率
                            array_push($data,''); //是否赠品
                            array_push($data,''); //商品条形码

                            $shop = $order_product->shop;
                            if($shop){
                                $shop_owner = $shop->owner;
                                array_push($data,$shop->name); //网店名称
                                array_push($data,$shop_owner->username); //网店账户
                            }else{
                                array_push($data,''); //网店名称
                                array_push($data,''); //网店账户
                            }
//                        //---------------------Single Column--------------------
//
//                        //------------------5-----------------------
//
                            array_push($data,$order->note); //卖家留言
                            array_push($data,$order->message); //买家留言
                            array_push($data,''); //是否赠品
                            array_push($data,''); //买家省份
                            array_push($data,''); //买家城市
                            array_push($data,''); //买家地区
                            array_push($data,''); //买家单位
                            array_push($data,''); //传真
                            array_push($data,''); //买家区号
//
//                        //-----------------9------------------------
//
                            array_push($data,''); //标签内容
                            array_push($data,''); //标签色
                            array_push($data,''); //部门
                            array_push($data,''); //客服人员
                            array_push($data,''); //摘要

                            array_push($data,'现金'); //结算方式

                            array_push($data,'人民币'); //币种
                            array_push($data,''); //汇率

                            array_push($data,''); //发票类型

                            array_push($data,''); //结算帐户


                            array_push($data,''); //卖家名称
                            array_push($data,''); //卖家地址
                            array_push($data,''); //业务员

                            //-----------------13------------------------

                            $sheet->row($row_num++, $data);

                        }
                    }

                }


            });
        })->download('xls');


    }

}
