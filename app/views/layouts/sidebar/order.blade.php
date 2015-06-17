@section('sidebar')
<div class="order-form-menu menu-item">
  <ul>
    <li>
      <a href="{{URL::route('orders.index')}}" > 所有订单</a>
    </li>
    <li>
      <a href="{{URL::route('orders.index',array('status'=>1))}}"> 未支付订单</a>
    </li>
    <li>
      <a href="{{URL::route('orders.index',array('status'=>6))}}"> 已关闭订单</a>
    </li>
    {{--<li>--}}
      {{--<a href="{{URL::route('orders.index',array('status'=>9))}}"> 交易成功</a>--}}
    {{--</li>--}}
    {{--<li>--}}
      {{--<a href="{{URL::route('orders.index',array('status'=>4))}}"> 售后／退款</a>--}}
    {{--</li>--}}
    {{--<li>--}}
      {{--<a href="#"> 订单概况</a>--}}
    {{--</li>--}}
  </ul>
  {{--<ul>--}}
    {{--<li>--}}
      {{--<a href="{{URL::route('orders.logistics')}}"> 物流设置</a>--}}
    {{--</li>--}}
    {{--<li>--}}
      {{--<a href="#"> 订单通知</a>--}}
    {{--</li>--}}
    {{--<li>--}}
      {{--<a href="{{URL::route('orders.inform_template')}}"> 通知模板</a>--}}
    {{--</li>--}}
  {{--</ul>--}}
</div>
@stop