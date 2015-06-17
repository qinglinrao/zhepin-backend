@section('sidebar')
<div class="catalog-menu menu-item">
  <ul>
     <li class="{{ $status==0?'active':'' }}">
       <a href="{{ URL::route('account_log').'?status=0'}}">提现申请</a>
     </li>
  </ul>
  {{--<ul>--}}
    {{--<li class="{{ $status==2?'active':'' }}">--}}
      {{--<a href="{{ URL::route('account_log').'?status=2' }}">已成功</a>--}}
    {{--</li>--}}
    {{--<li class="{{ $status==1?'active':'' }}">--}}
      {{--<a href="{{ URL::route('account_log').'?status=1' }}">未成功</a>--}}
    {{--</li>--}}
  {{--</ul>--}}
  {{--<ul>--}}
      {{--<li class="{{ $status==2?'active':'' }}">--}}
        {{--<a href="{{ URL::route('account_log').'?status=2' }}">可转账</a>--}}
      {{--</li>--}}
      {{--<li class="{{ $status==1?'active':'' }}">--}}
        {{--<a href="{{ URL::route('account_log').'?status=1' }}">无余额</a>--}}
      {{--</li>--}}
  {{--</ul>--}}


</div>
@stop