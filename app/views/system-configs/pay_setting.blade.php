@extends('layouts/interface')

@include('layouts.sidebar.system_config')

@section('main')
    {{Form::open(array('action'=>'SystemConfigController@postPaySetting'))}}
    <div class="pay_setting">
        <table>
            <tr>
                <td>支付宝帐号</td>
                <td>{{Form::text('payment[alipay_account]',$payment->alipay_account)}}</td>
            </tr>
            <tr>
                <td>合作者身份(PID)</td>
                <td>{{Form::text('payment[partner]',$payment->partner)}}</td>
            </tr>
            <tr>
                <td>加密方式</td>
                <td>
                    {{Form::select('payment[sign_type]',array('MD5'=>'MD5','0001'=>'0001'),$payment->sign_type)}}
                    {{--<select name="sign_type">--}}
                        {{--<option value="MD5">MD5</option>--}}
                        {{--<option value="0001">0001</option>--}}
                    {{--</select>--}}
                </td>
            </tr>
            <tr>
                <td>订单有效期</td>
                <td>
                    {{Form::select('payment[expiry_minutes]',get_order_expiry_minutes(),$payment->expiry_minutes)}}
                    {{--<select name="expiry_minutes">--}}
                        {{--<option value="5">5分钟</option>--}}
                        {{--<option value="10">10分钟</option>--}}
                        {{--<option value="15">15分钟</option>--}}
                        {{--<option value="30">30分钟</option>--}}
                        {{--<option value="45">45分钟</option>--}}
                        {{--<option value="60">1小时</option>--}}
                        {{--<option value="90">1.5小时</option>--}}
                        {{--<option value="120">2小时</option>--}}
                    {{--</select>--}}
                </td>
            </tr>
             <tr>
                <td>MD5加密(Key)</td>
                <td>
                    {{Form::textarea('payment[key]',$payment->key)}}
                </td>
            </tr>
             <tr>
                <td></td>
                <td>
                   <input type="submit" value="保存配置" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </div>
    {{ Form::close() }}
@stop