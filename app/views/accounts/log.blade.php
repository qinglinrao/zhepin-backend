@extends('layouts/interface')

@include('layouts.sidebar.account_log')

@section('main')
    <h4>财务记录</h4>
    <div class="data-list">
        <div class="table-warp account-log">
            <table class="table ">
                <thead>
                <tr>
                    <th>资料</th>
                    <th>交易类型</th>
                    <th>金额(元)</th>
                    <th>日志内容</th>
                    <th>支付宝帐号</th>
                    <th>支付宝用户名</th>
                    {{--<th>卡号</th>--}}
                    {{--<th>户主</th>--}}
                    {{--<th>开户银行</th>--}}
                    {{--<th>身份证</th>--}}
                    {{--<th>余额</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($account_logs as $log)
                    <tr class="first-tr">
                        <td colspan="5" class="merchant-name">{{$log->merchant->username}} &nbsp;&nbsp;&nbsp;&nbsp;手机号:{{$log->merchant->mobile}}</td>
                        <td colspan="2" class="created-at">时间:{{$log->created_at}}</td>
                    </tr>
                    <tr class="second-tr">
                        <td >
                            <b>{{$log->merchant->username}}</b>
                        </td>

                        <td>
                           {{--{{get_follow_link_name($log->merchant->merchant_grade,false)}}--}}
                           @if($log->operate_type == 1)
                            提现
                           @elseif($log->operate_type == 2)
                            分润
                           @endif
                        </td>
                        <td>
                            <b class="money {{$log->trade_type?'in':'out'}}">{{$log->trade_type?'+':'-'}}{{$log->money}}</b>
                        </td>
                        @if($log->operate_type == 2)
                        <td colspan="5" width="150">
                            日志:{{$log->log}}
                        </td>
                        @else
                        <td >
                            {{$log->log}}
                        </td>
                        <td >
                            {{$log->alipay_account}}
                        </td>
                        <td >
                            {{$log->alipay_name}}
                        </td>
                        {{--<td>--}}
                            {{--{{$log['bank_account_id']}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$log['bank_account_name']}} <br/>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{$log['bank_name']}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<a href="javascript:void(0)" class="open_id_card_check" data-val="{{$log['id']}}">查看</a>--}}
                        {{--</td>--}}
                        @endif
                        {{--<td><b class="money ">{{$log->trade_type?'+':'-'}}{{$log->money}}</b></td>--}}
                    </tr>
                    <tr class="_blank"> </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="action-bar">
            <div class="action-bar-left"></div>
            <div class="pagelist-right">
                    {{$account_logs->appends($input)->links()}}
            </div>
        </div>
    </div>

    <div class="id_card_check window">
        <h4 class="title">证件审核<button class="close_btn">X</button></h4>
        <iframe src=""></iframe>
    </div>
@stop
