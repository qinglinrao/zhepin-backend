@extends('layouts/interface')

@include('layouts.sidebar.customer')

@section('main')
    @include('customers._search_bar')
    <div class="data-list">
        @include('customers._action_bar')
        <div class="table-warp">
            <table class="table table-striped">
                <thead>
                <tr>
                    {{--<th></th>--}}
                    <th>头像</th>
                    <th>昵称</th>
                    {{--<th>年龄</th>--}}
                    {{--<th>性别</th>--}}
                    <th>总支付额(元)</th>
                    <th>订单数</th>
                    <th>手机号</th>
                    <th>上线</th>
                    {{--<th>所在地</th>--}}
                    <th>注册时间</th>
                    <th>美肤测试</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        {{--<td>--}}
                            {{--<label for="all-choose" class="check"></label>--}}
                            {{--<input type="checkbox"  class="checkbox son_checkbox" value="{{$customer['id']}}"/>--}}
                        {{--</td>--}}
                        <td>
                            <a href="#">
                                <img src="{{$customer->detail&&$customer->detail->image?AppHelper::imgSrc($customer->detail->image->url):'/images/user_default.png'}}" width="60" height="60"/>
                            </a>
                        </td>
                        <td>
                            <a href="#">{{$customer->detail['username']}}</a> <br/>
                            {{--<span>{{$customer->level->name}}</span>--}}
                        </td>
                        {{--<td>--}}
                            {{--{{$customer->detail->birthday}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$customer->detail->sex == 1?'男':'女'}} <br/>--}}
                        {{--</td>--}}

                        <td>
                            {{AppHelper::price($customer->order_total_pay)}} <br/>
                        </td>
                         <td>
                            {{$customer->order_total_num}} <br/>
                        </td>
                        <td>
                            {{$customer->mobile}} <br/>
                        </td>
                        <td>
                            {{$customer->merchant?$customer->merchant->username:'--'}} <br/>
                        </td>
                        {{--<td>--}}
                            {{--{{ CustomerHelper::render_region($customer) }}--}}
                        {{--</td>--}}

                        <td>
                            {{ $customer->created_at->format('Y-m-d') }}
                        </td>
                        <td>
                           <a href="{{URL::route('customer.detail',['id'=>$customer->id])}}" class="button button-block button-primary button-small button-small-padding">查看 </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('customers._action_bar')
    </div>
@stop
