@extends('layouts/interface')

@include('layouts.sidebar.account_log')

@section('main')
    <h4>提现记录</h4>
    <div class="select-sort">
        <ul>
            <li ><a href="{{URL::route('account_log')}}" class="button  {{!isset($type)?'button-primary':''}} button-rounded button-small" >全部</a></li>
            <li ><a href="{{URL::route('account_log').'?type=1'}}" class="button {{ $type == 1?'button-primary':''}} button-rounded button-small">代理商</a></li>
            <li ><a href="{{URL::route('account_log').'?type=2'}}" class="button {{ $type == 2?'button-primary':''}} button-rounded button-small">门店</a></li>
            <li ><a href="{{URL::route('account_log').'?type=3'}}" class="button {{ $type == 3?'button-primary':''}} button-rounded button-small" >BA</a></li>
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
                    <th>财务记录</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                    <tr class="first-tr">
                        <td colspan="7" class="merchant-name">{{$account->merchant->username}} &nbsp;&nbsp;&nbsp;&nbsp;手机号:{{$account->merchant->mobile}}</td>
                        <td colspan="2" class="created-at">{{$log->created_at}}</td>
                    </tr>
                    <tr class="second-tr">
                        <td  class="owner">
                            <img src="{{AppHelper::imgSrc($account->merchant->image->url)}}" width="100" height="100" />
                            <b>{{$account->merchant->username}}</b>
                        </td>
                        <td>
                           {{get_follow_link_name($account->merchant->merchant_grade,false)}}
                        </td>
                        <td>
                            <b class="money">{{$account->merchant['money']}}</b>
                        </td>
                        <td>
                            {{$account['bank_account_id']}}
                        </td>
                        <td>
                            {{$account['bank_account_name']}} <br/>
                        </td>
                        <td>
                            {{$account['bank_name']}}
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="open_id_card_check" data-val="{{$account['id']}}">查看</a>
                        </td>
                        <td>

{{--                            {{get_account_log_status()[$log->status]}}--}}
                        <a href="{{URL::route('account_log_detail',array('id'=>$account->merchant->id))}}">交易记录</a>
                        </td>
                        <td width="100">
                            {{get_account_status_action($account,$account->merchant)}}
                        </td>
                    </tr>
                    <tr class="_blank"> </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="action-bar">
            <div class="action-bar-left"></div>
            <div class="pagelist-right">
                    {{$accounts->appends($input)->links()}}
            </div>
        </div>
    </div>

    <div class="id_card_check window">
        <h4 class="title">证件审核<button class="close_btn">X</button></h4>
        <iframe src=""></iframe>
    </div>
@stop
