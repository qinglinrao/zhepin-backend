@extends('layouts/interface')

@include('layouts.sidebar.profit')

@section('main')
    @include('profits._search_bar')
    <div class="data-list">
        @include('profits._action_bar')
        <div class="table-warp merchants">
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
                    <th>上一级卖家</th>
                    <th>销售额<b class="table-sort {{$sort_name=='total_pay'?'sort-'.$sort_val:''}}" data-name="total_pay" ><e class="asc">▲</e><e class="desc">▼</e></b></th>
                    <th>下一级卖家<b class="table-sort {{$sort_name=='follower_num'?'sort-'.$sort_val:''}}" data-name="follower_num"><e class="asc">▲</e><e class="desc">▼</e></b></th>
                    <th>分润<b class="table-sort  {{$sort_name=='total_profit'?'sort-'.$sort_val:''}} " data-name="total_profit" ><e class="asc">▲</e><e class="desc">▼</e></b></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($merchants as $merchant)
                    <tr>
                        <td>
                            <label for="all-choose" class="check"></label>
                            <input type="checkbox"  class="checkbox son_checkbox" value="{{$merchant['id']}}"/>
                        </td>
                        <td width="100">
                            <a href="#">
                                <img src="{{$merchant->image?AppHelper::imgSrc($merchant->image->url):'/images/user_default.png'}}" width="80" height="80"/>
                            </a>
                        </td>
                        <td>
                            <a href="{{URL::route('merchants.detail',array('id'=>$merchant->id)).'?from='.$merchant->id.'&sc=true'}}"> {{$merchant['username']}}</a>
                            {{--<span>{{$merchant->level->name}}</span>--}}
                        </td>
                        <td>
                            {{ tranTime(strtotime($merchant['created_at'])) }}
                        </td>
                        <td>
                            {{$merchant->mobile}} <br/>
                        </td>
                        <td>
                            {{$merchant->region_id}}
                        </td>
                        <td>
                            {{get_merchant_status()[$merchant->status]}}
                        </td>
                        <td>
                            {{$merchant->leader->username}}
                        </td>
                        <td>

                            {{$merchant->total_pay}}元
                        </td>
                        <td>
                            <a href="{{URL::route('merchants.detail',array('id'=>$merchant->id)).'?leader='.$merchant->id.'&from='.$merchant->id}}"> {{get_follower_num($merchant)}}</a>
                        </td>
                        <td>
                            {{$merchant->total_profit}}元
                        </td>
                        <td width="100">
                            {{get_merchant_status_action($merchant)}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="clear: both;"></div>
        @include('profits._action_bar')
    </div>
@stop
