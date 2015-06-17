<?php

//根据status_id获取订单状态
function get_order_status(){
    return array(
//        0 => '已取消', //用户自己取消订单
//        1 => '待支付', //已下单
//        2 => '待收货',  //已支付
//        3 => '待评论', //已收货
//        4 => '已评论', //已评论
//        5 => '退款/售后', //买家已申请退款
//        6 => '退款成功', //商家已退款
//        7 => '已确认到帐', //买家已确认到帐
//        8 => '已关闭' //商家已拒绝订单

        1 => '待支付',
        2 => '待发货',
        3 => '待收货',
        4 => '待评论',
        5 => '已评论',
        6 => '退款/售后',
        7 => '退款中',
        8 => '退款成功',
        9 => '退款关闭',
        10 => '已拒绝',
        11 => '已取消',
        12 => '已分润'
    );
}

//根据订单组别编号来获取相应的订单状态数组
function get_order_status_group($id){
    $status_group = array(

        1 => array(1), //待支付
        2 => array(2), //待收货
        3 => array(3), //待评论
        4 => array(6,7,8,9), //售后/退款(包括退款成功,退款关闭)
        5 => array(6), //售后/退款
        6 => array(0,10), //已取消
    );
    if($id <= 6){
        return $status_group[$id];
    }else{
        if($id == 9) return array(2,3,4,5);
        else return array($id);
    }


}

function get_stock_status(){
    return array(
        1 => '500件以下',
        2 => '500～5K件',
        3 => '5K～5W件',
        4 => '5W～10W件',
        5 => '10W～100W件',
        6 => '100W件以上'
    );
}


function get_stock_array(){
    return array(
        1 => array(
          'from' => 0,
          'to' => 500,
        ),
        2 => array(
            'from' => 500,
            'to' => 5000
        ),
        3 => array(
            'from' => 5000,
            'to' => 50000
        ),
        4 => array(
            'from' => 50000,
            'to' => 100000
        ),
        5 => array(
            'from' => 100000,
            'to' => 1000000
        ),
        6 => array(
            'from' => 1000000,
            'to' => 999999999999
        )
    );
}



function tranTime($time){
    $rtime = $time;
    $time = time()-$time;
    if ($time<60){
        $str = "刚刚";
    }elseif ($time<60*10){
        $str = "1分钟前";
    }elseif ($time<60*20){
        $str = "10分钟前";
    }elseif ($time<60*60){
        $str = "30分钟前";
    }elseif ($time<60*60*2){
        $str = "1小时前";
    }elseif ($time<60*60*5){
        $str = "2小时前";
    }elseif ($time<60*60*12){
        $str = "5小时前";
    }elseif ($time<60*60*24){
        $str = "12小时前";
    }elseif ($time<60*60*24*2){
        $str = "1天前";
    }elseif ($time<60*60*24*5){
        $str = "2天前";
    }elseif ($time<60*60*24*7){
        $str = "5天前";
    }elseif ($time<60*60*24*7*2){
        $str = "1周前";
    }elseif ($time<60*60*24*7*3){
        $str = "2周前";
    }elseif ($time<60*60*24*7*4){
        $str = "3周前";
    }else{
        $str = date("y/m/d",$rtime);
    }
    return $str;
}


function get_customer_groups(){
    $groups = CustomerGroup::remember(10)->lists('name','id'); //TODO replace the site_id
    return $groups;

}

function get_status_name(){
    return array(

        1 => '买家已下单',
        2 => '买家已付款',
        3 => '商家已发货',
        4 => '物流签收',
        5 => '买家已评论',
        6 => '买家已申请退款',
        7 => '商家已退款',
        8 => '已确认到帐',
        9 => '商家拒绝退款',
        10 => '商家关闭订单',
        11 => '买家取消订单',
        12 => '订单已分润'
    );
}

function history_exist($history,$status_id){
    $count = $history->where('status_id',$status_id)->count();
    return $count<=0 ? false:true;
}

function history_datetime($order,$status_id){
    $history = CustomerOrderHistory::where('order_id',$order->id)->where('status_id',$status_id)->first();
    if($history){
        return $history->created_at;
    }else{
        return '';
    }
}

function get_all_provinces(){
    $provinces = Region::where('country_id',1)->where('province_id',0)->remember(10)->get(); //TODO replace the site_id
    $province_arr = array(
        '' => '--请选择省--'
    );
    foreach($provinces as $province){
        $province_arr[strval($province->id)] = $province['name'];
    }
    return $province_arr;
}

function get_order_expiry_minutes(){
    return array(
        '5' => '5分钟',
        '10' => '10分钟',
        '15' => '15分钟',
        '30' => '30分钟',
        '45' => '45分钟',
        '60' => '1小时',
        '90' => '1.5小时',
        '120' =>'2小时'
    );
}

function get_profit_templates(){
    $profits = ProductProfit::all();
    $templates = array(
        0 => '--不分润--'
    );
    foreach($profits as $profit){
        $templates[$profit->id] = $profit->name."(BA:$profit->ba%  门店:$profit->store%  代理商:$profit->agent%)";
    }
    return $templates;
}

function get_merchant_status(){

    return $array = array(
        '0' => '已拒绝入驻',
        '1' => '入驻待审核',
        '2' => '已入驻',
        '3' => '帐号已冻结'
    );
}

function get_merchant_status_action($merchant){
    $action = '';
    if($merchant->status == 1){
        $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>0)).'" class="button button-block button-highlight button-small button-small-padding" onclick="return confirm(\'您确定要拒绝?\')">拒绝入驻</a>';
        $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>2)).'" class="button button-block button-primary button-small button-small-padding">同意入驻</a>';
    }else if($merchant->status == 2){
        $action = $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>3)).'" class="button button-block button-small button-small-padding" onclick="return confirm(\'您确定要冻结此帐号?\')">冻结帐号</a>';
    }else if($merchant->status == 3){
        $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>2)).'" class="button button-block button-action button-small button-small-padding">解冻帐号</a>';
    }
    $action = $action.'<a href="'.URL::route('merchants.delete',array('id'=>$merchant->id)).'" class="button button-block button-caution button-small button-small-padding" onclick="return confirm(\'您确定要删除此帐号?\')">删除帐号</a>';
    return $action;
}

function get_follower_code_name($type){
    switch($type){
        case 1:
            return '门店';
        case 2:
            return 'BA';
        case 3:
            return '顾客';
    }
}

function get_follower_num($merchant){
    if($merchant->merchant_grade == 3){
        return $merchant->customer_num;
    }
    return $merchant->follower_num;
}


function get_follow_link_name($type,$sc){
    if($sc){
        return '顾客';
    }
    switch($type){
        case 1:
            return '代理商';
            break;
        case 2:
            return '门店';
            break;
        case 3:
            return 'BA';
            break;
        case 4:
            return '顾客';
            break;
    }
}

function get_follow_link($fromer,$leader,$sc=false){
    if($sc){
        return generate_follower_url($leader,$leader,$sc);
        //return '<a href="'.get_follow_url($leader,$leader).'">'.$fromer->username.'('.get_follow_link_name($fromer->merchant_grade,false).')的顾客'."</a>";
    }
    else if($fromer->id == $leader->id){
        return generate_follower_url($fromer,$leader,false);
//        return '<a href="'.get_follow_url($fromer,$leader).'">'.$fromer->username.'('.get_follow_link_name($fromer->merchant_grade,false).')的'.get_follow_link_name($fromer->merchant_grade+1,false)."</a>";
    }else if($leader->leader->id == $fromer->id){
        return generate_follower_url($fromer,$leader->leader,false).' > '.generate_follower_url($fromer,$leader,false);
//        return '<a href="'.get_follow_url($fromer,$leader->leader).'">'.$fromer->username.'('.get_follow_link_name($fromer->merchant_grade,false).')的'.get_follow_link_name($fromer->merchant_grade+1,false)."</a> > ".'<a href="'.get_follow_url($fromer,$leader).'">'.$leader->username.'('.get_follow_link_name($leader->merchant_grade,false).')的'.get_follow_link_name($leader->merchant_grade+1,false)."</a>";;
    }else{
        return generate_follower_url($fromer,$fromer,false).' > '.generate_follower_url($fromer,$leader->leader,false).' > '.generate_follower_url($fromer,$leader,false);
//        return '<a href="'.get_follow_url($fromer,$fromer).'">'.$fromer->username.'('.get_follow_link_name($fromer->merchant_grade,false).')的'.get_follow_link_name($fromer->merchant_grade+1,false)."</a> > ".'<a href="'.get_follow_url($fromer,$leader->leader).'">'.$leader->leader->username.'('.get_follow_link_name($leader->leader->merchant_grade,false).')的'.get_follow_link_name($leader->leader->merchant_grade+1,false)."</a> > ".'<a href="'.get_follow_url($fromer,$leader).'">'.$leader->username.'('.get_follow_link_name($leader->merchant_grade,false).')的'.get_follow_link_name($leader->merchant_grade+1,false)."</a>";
    }
}

function generate_follower_url($fromer,$leader,$sc=false){
    return '<a href="'.get_follow_url($fromer,$leader).'">'.$leader->username.'('.get_follow_link_name($leader->merchant_grade,false).')的'.get_follow_link_name($leader->merchant_grade+1,$sc)."</a>";
}

function get_follow_url($fromer,$leader){
    return $url = URL::route('merchants.detail',array('id'=>$leader->id)).'?from='.$fromer->id;
}

function get_merchant_detail_status_action($merchant){
    $action = '';
    if($merchant->status == 1){
        $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>0)).'" class="button button-highlight button-small button-small-padding" onclick="return confirm(\'您确定要拒绝?\')">拒绝入驻</a>';
        $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>2)).'" class="button button-primary button-small button-small-padding">同意入驻</a>';
    }else if($merchant->status == 2){
        $action = $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>3)).'" class="button  button-small button-small-padding" onclick="return confirm(\'您确定要冻结此帐号?\')">冻结帐号</a>';
    }else if($merchant->status == 3){
        $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$merchant->id,'status'=>2)).'" class="button  button-action button-small button-small-padding">解冻帐号</a>';
    }
    $action = $action.'<a href="'.URL::route('merchants.delete',array('id'=>$merchant->id)).'" class="button  button-caution button-small button-small-padding" onclick="return confirm(\'您确定要删除此帐号?\')">删除帐号</a>';
    return $action;
}

//获得下线总销售额
function get_follower_total_pay($merchant){
    $followers = $merchant->follower();
    $total_pay = 0;
    foreach($followers as $follower){
        $total_pay += $follower->total_pay;
    }
    return $total_pay;
}

function get_follower_total_order($merchant){
    $total_order = 0;
    $followers = $merchant->follower();
    foreach($followers as $follower){
        $total_order += $follower->order_num;
    }
    return $total_order;
}

function get_customer_status(){
    return array(
        '1' => '正常',
        '2' => '已冻结'
    );
}
function get_customer_status_action($customer){
    $action = '';
    if($customer->status == 1){
        $action = $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$customer->id,'status'=>2)).'" class="button button-block button-small button-small-padding" onclick="return confirm(\'您确定要冻结此帐号?\')">冻结帐号</a>';
    }else if($customer->status == 2){
        $action = $action.'<a href="'.URL::route('merchants.change_status',array('id'=>$customer->id,'status'=>1)).'" class="button button-block button-action button-small button-small-padding">解冻帐号</a>';
    }
    $action = $action.'<a href="'.URL::route('merchants.delete',array('id'=>$customer->id)).'" class="button button-block button-caution button-small button-small-padding" onclick="return confirm(\'您确定要删除此帐号?\')">删除帐号</a>';
    return $action;
}

function get_account_log_status(){
    return array(
        '0' => '已拒绝',
        '1' => '待审核',
        '2' => '已同意'
    );
}

//function get_account_status_action($account){
//    $action = '';
//    if($account->status == 0){
//
//        $action = '<span>已拒绝</span>';
//    }else if($account->status == 1){
//        $action = $action.'<a href="'.URL::route('merchants.change_account_status',array('id'=>$account->id,'status'=>2)).'" class="button button-block button-primary button-small button-small-padding" >同意</a>';
//        $action = $action.'<a href="'.URL::route('merchants.change_account_status',array('id'=>$account->id,'status'=>0)).'" class="button button-block button-caution button-small button-small-padding" onclick="return confirm(\'您确定要拒绝?\')">拒绝</a>';
//    }else if($account->status == 2){
//        $action = '<span>已同意</span>';
//    }
//
//    return $action;
//}

function get_account_status_action($account,$merchant){

    $action = '';
    if($account->status == 1){
        if($merchant){
            if($merchant->money<= 0){
                $action = '<span>无余额</span>';
            }else if($merchant->money > 0){
                $action = $action.'<a href="'.URL::route('merchants.account_money_clear',array('id'=>$merchant->id)).'" class="button button-block button-primary button-small button-small-padding" onclick="return confirm(\'您确定已将客户余额已全额转入其账户?确认后客户账户余额将清零!\')">全额转账</a>';
            }
        }else{
            $action = '<span>无余额</span>';
        }
    }else{
        $action =  '<a href="#" class="button button-block button-small button-small-padding disabled" >信息未完善</a>';
    }


    return $action;
}

function get_account_log_status_arr($status){
    $arr = array(
        '0' => array(0,1,2),
        '1' => array(1),
        '2' => array(2)
    );
    if($status > 2 || $status < 0) return $arr[0];
    else return $arr[$status];
}

function mkFolder($path)
{
    if(file_exists($path)){
        if(is_dir($path)){
            chmod($path, 0777);
        }else{
            Log::info('文件不存在');
            mkdir($path,0777,true);
            chmod($path, 0777);
        }
    }else{
        Log::info('直接创建');
        mkdir($path,0777,true);
        chmod($path, 0777);
    }
}

function get_root_categories(){
    $categories = ProductCategory::where('parent_id',null)->lists('name','id');
    return $categories;
}
function get_root_category_id($category_id,$flage=true){
    $category = ProductCategory::where('id',$category_id)->first();
    if($category){
        if($flage){
            return $category->parent_id?$category->parent_id:$category_id;
        }else{
            return $category->parent_id?$category->id:null;
        }

    }else{
        return null;
    }

}
function get_second_categories($category_id){
    $category = ProductCategory::where('id',$category_id)->first();
    $categories = [''=>'二级分类'];
    if($category->parent_id){
        $categories = $categories + ProductCategory::where('parent_id',$category->parent_id)->lists('name','id');
    }else if($category){
        $categories = $categories + ProductCategory::where('parent_id',$category_id)->lists('name','id');
    }

    return $categories;
}
//1 => '买家已下单',
//        2 => '买家已付款',
//        3 => '商家已发货',
//        4 => '物流签收',
//        5 => '买家已评论',
//        6 => '买家已申请退款',
//        7 => '商家已退款',
//        8 => '已确认到帐',
//        9 => '商家拒绝退款',
//        10 => '商家关闭订单',
//        11 => '买家取消订单',
//        12 => '订单已分润'
function get_order_status_action($order){
    if($order->is_profited){
        return '<a href="#" class="button button-block button-small button-small-padding disabled" >已分润</a>';
    }else{
        switch($order->status_id){
            case 2 :
                return '<a href="'.URL::route('orders.detail',array('id'=>$order->id)).'#deliver-action" class="button button-block button-primary button-small button-small-padding">发货</a>';
                break;
            case 6 :
                return '<a href="'.URL::route('orders.change_status',array('order_id'=>$order->id,'status'=>7)).'" class="button button-block button-action button-small button-small-padding">同意退款/退货</a>'.
                '<a href="'.URL::route('orders.change_status',array('order_id'=>$order->id,'status'=>9)).'" class="button button-block button-caution button-small button-small-padding" onclick="return confirm(\'您确定要拒绝？\')">拒绝退款/退货</a>';
                break;
            default :
                return '<a href="#" class="button button-block button-small button-small-padding disabled" >'.get_order_status()[$order->status_id].'</a>';
                break;
        }


    }
}

function get_logistics(){
    $logistic = array(
        '' => '--请选择物流公司--'
    );
    return $logistic = $logistic + LogisticsCompany::lists('name','id');
}

function account_log_action_right($log,$status){
    $status_right = array(
        0=> array(),
        1=> array(0,2),
        2=>array()
    );
    if($status > 2){
        return false;
    }else{
        return in_array($status,$status_right[$log->status]);
    }
}

function get_category_name($product){
    $category = $product->category;
    if($category->parentCategory){
        return $category->parentCategory->name." ".$category->name;
    }else{
        return $category->name;
    }
}


function confirm_order_action($order_status,$action_status){
    $actions = array(
        1 => array(11), //下单之后 -> (11) 取消订单 (2) 支付订单
        2 => array(3), //支付之后 ->  (6) 退款/售后
        3 => array(4), //发货后  -> (4) 收货
        4 => array(), //收货后 -> (5) 评论
        5 => array(), //评论完 -> 无
        6 => array(7,9), //退款售后 -> 无
        7 => array(), //商家已退款 -> (8) 确认收款
        8 => array(), //收款之后 -> 无
        9 => array(), //退款关闭
        10 => array() //用户取消订单后

    );
    if($actions[$order_status]){
        return in_array($action_status,$actions[$order_status]);
    }else{
        return false;
    }

}




function remove_leading_zero($str,$is_str=false){

    Log::info('------------------------------BEGIN-----------------------------------');
    Log::info($str);
    if($is_str){
//        Log::info(preg_replace("/^(0+)(.+)$/i","\$1",$str));
//        return preg_replace("/^(0+)(.+)$/i","\$1",$str);
    }else{
        return $str;
    }
    Log::info('------------------------------END-----------------------------------');



}