@extends('layouts/interface')

@include('layouts.sidebar.order')

@section('main')
<div class="order-form-detail">
  <div class="serial-number">
    订单号：<span>{{$order['order_sn']}}</span>
  </div>
  {{--<div class="flow-step">--}}
    {{--<ul class="clearfix">--}}
      {{--<li class="first">--}}
        {{--<div class="step-wrap {{history_exist($order->histories(),1) ? 'step-done':''}} ">--}}
            {{--<div class="step-name">{{get_status_name()[1]}}</div>--}}
            {{--<div class="step-num"></div>--}}
            {{--<div class="step-time">{{history_datetime($order,1)}}</div>--}}
        {{--</div>--}}
      {{--</li>--}}
      {{--<li>--}}
        {{--<div class="step-wrap {{history_exist($order->histories(),2) ? 'step-done':''}}">--}}
            {{--<div class="step-name">{{get_status_name()[2]}}</div>--}}
            {{--<div class="step-num"></div>--}}
            {{--<div class="step-time">{{history_datetime($order,2)}}</div>--}}
        {{--</div>--}}
      {{--</li>--}}
       {{--@if(in_array($order->status_id,array(6,7,8,9)))--}}
          {{--<li>--}}
            {{--<div class="step-wrap {{history_exist($order->histories(),6) ? 'step-done':''}}">--}}
                {{--<div class="step-name">{{get_status_name()[6]}}</div>--}}
                {{--<div class="step-num"></div>--}}
                {{--<div class="step-time">{{history_datetime($order,6)}}</div>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<li>--}}
            {{--<div class="step-wrap {{history_exist($order->histories(),7) ? 'step-done':''}}">--}}
                {{--<div class="step-name">{{get_status_name()[7]}}</div>--}}
                {{--<div class="step-num"></div>--}}
                {{--<div class="step-time">{{history_datetime($order,7)}}</div>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<li class="last">--}}
            {{--<div class="step-wrap {{history_exist($order->histories(),8) ? 'step-done':''}}">--}}
                {{--<div class="step-name">{{get_status_name()[8]}}</div>--}}
                {{--<div class="step-num"></div>--}}
                {{--<div class="step-time">{{history_datetime($order,8)}}</div>--}}
            {{--</div>--}}
          {{--</li>--}}
       {{--@else--}}
          {{--<li>--}}
            {{--<div class="step-wrap {{history_exist($order->histories(),3) ? 'step-done':''}}">--}}
                {{--<div class="step-name">{{get_status_name()[3]}}</div>--}}
                {{--<div class="step-num"></div>--}}
                {{--<div class="step-time">{{history_datetime($order,3)}}</div>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<li>--}}
            {{--<div class="step-wrap {{history_exist($order->histories(),4) ? 'step-done':''}}">--}}
                {{--<div class="step-name">{{get_status_name()[4]}}</div>--}}
                {{--<div class="step-num"></div>--}}
                {{--<div class="step-time">{{history_datetime($order,4)}}</div>--}}
            {{--</div>--}}
          {{--</li>--}}
          {{--<li class="last">--}}
            {{--<div class="step-wrap {{history_exist($order->histories(),5) ? 'step-done':''}}">--}}
                {{--<div class="step-name">{{get_status_name()[5]}}</div>--}}
                {{--<div class="step-num"></div>--}}
                {{--<div class="step-time">{{history_datetime($order,5)}}</div>--}}
            {{--</div>--}}
          {{--</li>--}}
       {{--@endif--}}
    {{--</ul>--}}
  {{--</div>--}}
  <div class="order-overview">
    <table>
      <tbody>
	<tr>
	  <td >
	    <p>订单概况</p>
	  </td>
	  {{--<td class="sec">--}}
	    {{--<p>商家备注<a href="#">备注</a></p>--}}
	  {{--</td>--}}
	</tr>
	<tr>
	  <td >
	    <p>订单状态:<span>{{get_order_status()[$order['status_id']]}}</span></p>
	    <p>下单时间:<span>{{$order->created_at}}</span></p>
	    <p>订单总计:<span>¥{{$order['total']}}</span></p>
	    <p>收货人:<span>{{$order->orderAddress['name']}}</span></p>
	    <p>收货地址:<span>{{$order->orderAddress['alias']}}</span></p>
	    <p>联系方式:<span>{{$order->orderAddress['mobile'] ?$order->orderAddress['mobile'] : $order->orderAddress['telephone'] }}</span></p>
	    {{--<p>下单用户:<span>{{$order->customer['username']}}</span></p>--}}
	     @if(in_array($order->status_id,array(3,4,5,12)))
	     <p>物流公司:<span>{{$order->logistics->name}}</span></p>
	     <p>物流单号:<span>{{$order->logistics_num}}</span></p>
	    {{--<p>付款方式:<span>支付宝支付</span></p>--}}
        {{--<p>交易单号:<span> 324456567678876543123456234</span></p>--}}
        {{--<p>物流方式:<span> 顺丰快递</span></p>--}}
        @endif
        {{--<P>收货信息:<span> {{$order->orderAddress['alias']}}  {{$order->orderAddress['name']}}   {{$order->orderAddress['mobile'] ?$order->orderAddress['mobile'] : $order->orderAddress['telephone'] }}  </span></P>--}}
	  </td>
	  {{--<td class="sec">--}}
	    {{--<i class="remark">--}}
	        {{--{{$order['message']}}--}}
	        {{--<br>--}}
	    {{--（该条备注只有商家可以看到）--}}
	    {{--</i>--}}
	  {{--</td>--}}
	</tr>
      </tbody>
    </table>
  </div>
  {{--@if(in_array($order->status_id,array(6,7,8,9)))--}}
  {{--<div class="refund-information">--}}
    {{--<table>--}}
      {{--<tbody>--}}
	{{--<tr>--}}
	  {{--<td class="number">退款流水号</td>--}}
	  {{--<td class="time"> 退款时间</td>--}}
	  {{--<td >发放方式</td>--}}
	  {{--<td >退款金额</td>--}}
	  {{--<td >退款状态</td>--}}
	{{--</tr>--}}
	{{--<tr>--}}
	  {{--<td >2313244556556</td>--}}
	  {{--<td >2014-12-13 11:21:23</td>--}}
	  {{--<td >支付宝退款</td>--}}
	  {{--<td >630.00</td>--}}
	  {{--<td >已确认到账</td>--}}
	{{--</tr>--}}
      {{--</tbody>--}}
    {{--</table>--}}
  {{--</div>--}}
  {{--@endif--}}
  <div class="product-information">
    <table>
      <thead>
	<tr>
	  <th colspan="2">商品名称</th>
	  <th >单价（元）</th>
	   <th >数量</th>
	  <th >规格</th>
	  <th >小计（元）</th>
	  <th >状态</th>
	  <th >总计</th>
	</tr>
      </thead>
      <tbody>
       @foreach($order->orderProducts as $orderProduct)
        <tr>
          <td class="one">
{{--            {{ HTML::image($orderProduct->product->thumb->url, '', ['width'=>60, 'height'=>60]) }}--}}
            <img src="{{$orderProduct->product&&$orderProduct->product->thumb?AppHelper::imgSrc($orderProduct->product->thumb->url):''}}" width="60" height="60">
          </td>
          <td class="two">
              <p><a href="#">{{$orderProduct['name']}}</a></p>
              <i>编号：<span>{{$orderProduct->productEntity->id}}</span></i>
          </td>
          <td class="three">￥{{$orderProduct->price}}</td>
          <td class="five">{{$orderProduct->quantity}}</td>
          <td class="four">{{$orderProduct->productEntity->option_set_values}}</td>
          <td class="six">￥{{$orderProduct->total}}</td>
          <td class="sev">{{get_order_status()[$order->status_id]}}</td>
          <td class="eig">￥{{$order->total}} </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{--<div class="total">--}}
    {{--<p>商品小计：<span>¥{{$order->total}}</span></p>--}}
    {{--<p>运费：<span>¥10.00</span></p>--}}
    {{--<p>实收款：<i>¥{{$order->total+10}}</i></p>--}}
  {{--</div>--}}
 <p class="form-tip">{{$errors->first()}}</p>
  @if($order->status_id == 2)
  <div class="deliver-form" id="deliver-action">
    {{Form::open(array('url'=>URL::route('orders.deliever')))}}
       <table>
           <tr>
            <td>
                {{Form::hidden('order_id',$order->id)}}
                {{Form::select('logistics_company_id',get_logistics(),null,array('class'=>''))}}
            </td>
           </tr>
           <tr>
               <td>
                   {{Form::text('logistics_num',null,array('placeholder'=>'请输入物流编号'))}}
               </td>
          </tr>
          <tr>
            <td><input type="submit" value="发货"/> </td>
          </tr>
       </table>
    {{Form::close()}}
  </div>
  @endif

</div>

@stop