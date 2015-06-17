@section('sidebar')
<div class="vip-menu menu-item">
  <ul>
    {{--<li>--}}
      {{--<a href="#"> 会员图谱</a>--}}
    {{--</li>--}}
    <li class="{{ Active::path('customers') }}">
      <a href="{{ URL::route('customers.index') }}"> 会员列表</a>
    </li>
    {{--<li class="{{ Active::path('customers/') }}">--}}
      {{--<a href="{{ URL::route('customers.index') }}"> 会员分组</a>--}}
    {{--</li>--}}
    {{--<li>--}}
      {{--<a href="#"> 会员黑名单</a>--}}
    {{--</li>--}}
  {{--</ul>--}}
  {{--<ul>--}}
    {{--<li>--}}
      {{--<a href="#"> 消息模版</a>--}}
    {{--</li>--}}
    {{--<li class="{{ Active::path('customer-levels') }}">--}}
      {{--<a href="{{ URL::route('customer-levels.index') }}"> 会员等级</a>--}}
    {{--</li>--}}
    {{--<li>--}}
      {{--<a href="#"> 安全中心</a>--}}
    {{--</li>--}}
  </ul>
</div>
@stop