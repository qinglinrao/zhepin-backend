@extends('layouts/interface')

@include('layouts.sidebar.account_log')

@section('main')
    <h4>提现记录</h4>
    <div class="select-sort">
        <ul>
            <li ><a href="{{URL::route('account_log').'?status='.$status}}" class="button  {{!isset($type)?'button-primary':''}} button-rounded button-small" >全部</a></li>
            <li ><a href="{{URL::route('account_log').'?status='.$status.'&type=1'}}" class="button {{ $type == 1?'button-primary':''}} button-rounded button-small">代理商</a></li>
            <li ><a href="{{URL::route('account_log').'?status='.$status.'&type=2'}}" class="button {{ $type == 2?'button-primary':''}} button-rounded button-small">门店</a></li>
            <li ><a href="{{URL::route('account_log').'?status='.$status.'&type=3'}}" class="button {{ $type == 3?'button-primary':''}} button-rounded button-small" >BA</a></li>
        </ul>
    </div>
    <div class="data-list">
        <div class="table-warp account-log">
            <table class="table ">
                <thead>
                <tr>
                    <th>资料</th>
                    <th>账户</th>
                    <th>金额(元)</th>
                    <th>卡号</th>
                    <th>户主</th>
                    <th>开户银行</th>
                    <th>身份证</th>
                    <th>状态</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($account_logs as $log)
                    <tr class="first-tr">
                        <td colspan="7" class="merchant-name">{{$log->merchant->username}} &nbsp;&nbsp;&nbsp;&nbsp;手机号:{{$log->merchant->mobile}}</td>
                        <td colspan="2" class="created-at">{{$log->created_at}}</td>
                    </tr>
                    <tr class="second-tr">
                        <td  class="owner">
                            <img src="{{AppHelper::imgSrc($log->merchant->image->url)}}" width="100" height="100" />
                            <b>{{$log->merchant->username}}</b>
                        </td>
                        <td>
                           {{get_follow_link_name($log->merchant->merchant_grade,false)}}
                        </td>
                        <td>
                            {{$log['money']}}
                        </td>
                        <td>
                            {{$log['bank_account_id']}}
                        </td>
                        <td>
                            {{$log['bank_account_name']}} <br/>
                        </td>
                        <td>
                            {{$log['bank_name']}}
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="open_id_card_check" data-val="{{$log['id']}}">查看</a>
                        </td>
                        <td>

                            {{get_account_log_status()[$log->status]}}
                        </td>
                        <td width="100">
                            {{get_account_status_action($log)}}
                        </td>
                    </tr>
                    <tr class="_blank"> </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('profits._log_action_bar')
    </div>

    <div class="id_card_check window">
        <h4 class="title">证件审核<button class="close_btn">X</button></h4>
        <iframe src=""></iframe>
    </div>
@stop
