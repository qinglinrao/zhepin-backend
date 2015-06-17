<div class="merchant-detail-info">
    <div class="follow-link">
        {{get_follow_link($fromer,$leader,$sc)}}
    </div>
    <div class="personal-info">
        <img src="{{$leader->image?AppHelper::imgSrc($leader->image->url):''}}" />
        <table >
            <tr>
                <td>
                    <b>
                        {{$leader->username}}({{get_follow_link_name($leader->merchant_grade,false)}})
                    </b>
                    <div class="action-button-groups">
                        {{get_merchant_detail_status_action($leader)}}
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <e>店铺名:{{$leader->shop&&$leader->shop->name?$leader->shop->name:'--'}}</e> |
                    <e>注册时间:{{$leader->created_at}}</e> |
                    <e>所在地:{{$leader->region_id}}</e> |
                    <e>手机号:{{$leader->mobile}}</e> |
                    <e>身份证号:{{$leader->identity_num}}</e> |
                    <e>状态: {{get_merchant_status()[$leader->status]}}</e>
                </td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>
    <div class="other-info">
        <h4 class="title">店铺信息</h4>
        <div class="detail-info">
            <table>
                <tr>
                    <td>
                        <div class="shop-info">
                            <e> 商品数量:{{$leader->shop && $leader->shop->products ? $leader->shop->products->count() : 0}}</e> |
                            <e> 销售额:{{get_follower_total_pay($leader)}}</e> |
                            <e> 客户:{{$leader->customer_num}}</e> |
                            <e> 订单:{{$leader->order_num}}</e> |
                            <e> 分润:{{$leader->shop_profit}}</e>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <div style="clear: both;"></div>
    <div class="other-info">
        <h4 class="title">{{get_follow_link_name($leader->merchant_grade+1,$sc)}}信息</h4>
        <div class="detail-info">
            <table>
                <tr>
                    <td>
                        <div class="order-info">
                            <e> {{get_follow_link_name($leader->merchant_grade+1,$sc)}}:{{$leader->follower_num}}</e> |
                            <e> 销售额:{{get_follower_total_pay($leader)}}</e> |
                            <e> 订单:{{get_follower_total_order($leader)}}</e> |
                            <e> 分润:{{$leader->follower_profit}}</e>
                        </div>
                    </td>
                    <td>
                        <div class="pay-info">
                            <e> 累计收入:{{$leader->total_profit}}</e> |
                            <e> 账户余额:{{$leader->money}}</e>
                        </div>
                    </td>
                    <td>
                        <div class="action-info">
                            <a href="{{URL::route('merchants.account_log',array('id'=>$leader->id))}}" >查看提现记录</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

    </div>

</div>