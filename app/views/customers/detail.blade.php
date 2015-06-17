@extends('layouts/interface')

@include('layouts.sidebar.customer')

@section('main')
    <div class="customer-detail">
        <h4 class="title">个人详情</h4>
        <table>
            <tr>
                <td>
                    <img src="{{$customer->detail&&$customer->detail->image?AppHelper::imgSrc($customer->detail->image->url):''}}" />
                </td>
                <td>
                    {{$customer->detail->username}}  {{$customer->detail->sex}} <br>
                    肌肤性质:{{$customer->detail->skin_type_id}}
                </td>
            </tr>
        </table>
    </div>
    <div class="order-form-list-wrap">

     <div class="order-form-list-con">
      @include('orders._action_bar')
      <div class="order-form-list">
            <div class="order-form-th">
              <table>
                <tbody>
                  <tr>
                <th class="one">商品信息</th>
                <th class="two">单价／数量</th>
                {{--<th class="three">优惠信息</th>--}}
                <th class="four">商品规格</th>
                <th class="five">库存</th>
                {{--<th class="six">发票类型</th>--}}
                {{--<th class="sev">商品操作</th>--}}
                <th class="eig">订单详情</th>
                <th class="nine">收货信息</th>
                <th class="ten"></th>
                  </tr>
                </tbody>
              </table>
            </div>
            @foreach($orders as $order)
            <div class="order-form-item">
              <div class="item-top clearfix">
                <div class="top-left">
                  {{--<input type="checkbox"  class="checkbox son_checkbox"/>--}}
                  <i>订单编号：<span>{{$order->order_sn}}</span></i><i>下单时间：<span>{{$order['created_at']}}</span></i>
                </div>
                <div class="top-right">
                  <span>{{get_order_status()[$order->status_id]}}-</span>
                  {{ HTML::linkRoute('orders.detail', '查看详情', ['id'=>$order->id],['class'=>'detail-link']) }}
                  {{--<a href="" class="detail-link" >查看详情</a>--}}
                  @if (!in_array($order->status_id,array(11,10)))
                  <a href="{{URL::route('orders.close',array('id'=>$order->id))}}" onclick="return confirm('您确定要关闭订单吗?')">关闭</a>
                  @else
                   <a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                  @endif
                </div>
              </div>
              <table class="table-wrap">
                <tbody>
                  <tr>
                    <td class="first wrap-td">
                      <table>
                        <tbody>
                          @foreach($order->orderProducts as $order_product)
                          <tr>
                            <td class="one">
                              <a href="#">
                              {{ HTML::image($order_product->product->thumb->url, '', ['width'=>60, 'height'=>60]) }}
                              </a>
                            </td>
                            <td class="two">
                              <div class="td-wrap">
                                <p><a href="#">{{$order_product->name}}</a></p>
                                <i>编号：<span>{{$order_product->sku}}</span></i>
                              </div>
                            </td>
                            <td class="three">￥{{$order_product->price}} × {{$order_product->quantity}}</td>
                            {{--<td class="four"><img src="images/preferential-icon.png" title="30"></td>--}}
                            <td class="five">
                                    {{--<span>蓝色</span>/<span>37</span>--}}
                                    {{$order_product->productEntity->option_set_values}}
                            </td>
                            <td class="six">{{$order_product->productEntity ? $order_product->productEntity->stock : ''}}</td>
                            {{--<td class="eig">普通发票</td>--}}
                            {{--<td class="eig">--}}
                              {{--<a href="#" class="trading-success">交易成功</a>--}}
                              {{--<a href="#" >交易成功</a>--}}
                            {{--</td>--}}
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </td>
                <td class="wrap-td">
                    <p>商品总价：￥{{$order->total}}</p>
                    {{--<p>运费：￥800.00</p>--}}
                    {{--<p>红包：￥800.00</p>--}}
                    {{--<p>积分：￥800.00</p>--}}
                    {{--<p>实付：￥{{$order->total}}</p>--}}
                    {{--<p class="last"><a href="#" class="to-revise">修改</a></p>--}}
                </td>
                <td class="wrap-td">
                  <p>收件人：{{$order->orderAddress['name']}}</p>
                  <p>手机号：{{$order->orderAddress['telephone'] }}</p>
                  <p>地址：{{$order->orderAddress['alias']}}</p>
                  {{--<p class="last"><a href="#" class="to-revise">修改</a></p>--}}
                </td>
                <td class="wrap-td ten">
                  {{get_order_status_action($order)}}
                </td>
                  </tr>
                </tbody>
              </table>
            </div>
            @endforeach
            @include('orders._action_bar')
      </div>
    </div>
    </div>
@stop
