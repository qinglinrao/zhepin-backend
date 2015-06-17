@extends('layouts/interface')

@include('layouts.sidebar.profit')

@section('main')
    @include('profits._customer_detail_info')
    <div class="data-list">
        @include('profits._customer_action_bar')
        <div class="table-warp merchants-detail">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>头像</th>
                    <th>昵称</th>
                    <th>注册时间</th>
                    <th>手机号</th>
                    <th>所在地</th>
                    <th>状态</th>
                    <th>上线</th>
                    <th>订单总价<b class="table-sort {{$sort_name=='order_total_pay'?'sort-'.$sort_val:''}}" data-name="order_total_pay" ><e class="asc">▲</e><e class="desc">▼</e></b></th>
                    <th>订单总数<b class="table-sort {{$sort_name=='order_total_num'?'sort-'.$sort_val:''}}" data-name="order_total_num"><e class="asc">▲</e><e class="desc">▼</e></b></th>
                    <th>分润<b class="table-sort  {{$sort_name=='ba_profit'?'sort-'.$sort_val:''}} " data-name="ba_profit" ><e class="asc">▲</e><e class="desc">▼</e></b></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>
                            <label for="all-choose" class="check"></label>
                            <input type="checkbox"  class="checkbox son_checkbox" value="{{$customer['id']}}"/>
                        </td>
                        <td width="100">
                            <a href="#">
                                @if($customer->detail && $customer->detail->image && $customer->detail->image->url)
                                <img src="{{AppHelper::imgSrc($customer->detail->image->url)}}" width="80" height="80"/>
                                @endif
                            </a>
                        </td>
                        <td>
                            <a href="#">{{$customer->detail['username']}}</a> <br/>
                            {{--<span>{{$merchant->level->name}}</span>--}}
                        </td>
                        <td>
                            {{ tranTime(strtotime($customer['created_at'])) }}
                        </td>
                        <td>
                            {{$customer->mobile}} <br/>
                        </td>
                        <td>
                            {{$customer->detail->region_id}}
                        </td>
                        <td>
                            {{get_customer_status()[$customer->status]}}
                        </td>
                        <td>
                            <a href="{{get_follow_url($customer->merchant,$customer->merchant)}}">{{$customer->merchant->username}}</a>
                        </td>
                        <td>

                            {{$customer->order_total_pay}}元
                        </td>
                        <td>
                            {{$customer->order_total_num}}
                        </td>
                        <td>
                            {{$customer->ba_profit}}元
                        </td>
                        <td width="100">
                            {{get_customer_status_action($customer)}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="clear: both;"></div>
        @include('profits._customer_action_bar')
    </div>
@stop
