@extends('layouts/interface')

@include('layouts.sidebar.profit')

@section('main')
    <h4>提现记录</h4>
    @include('profits._log_detail_info')
    <div class="data-list">
        @include('profits._log_action_bar')
        <div class="table-warp account-log-detail">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>时间</th>
                    <th>金额(元)</th>
                    <th>银行帐号</th>
                    <th>户主</th>
                    <th>开户银行</th>
                    <th>身份证</th>
                    <th>提现账户</th>
                    <th>状态</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($account_logs as $log)
                    <tr >

                        <td>
                            {{$log['created_at']}}
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
                            {{$leader->username}}
                        </td>
                        <td>

                            {{get_account_log_status()[$log->status]}}
                        </td>
                        <td width="100">
                            {{get_account_status_action($log)}}
                        </td>
                    </tr>
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
