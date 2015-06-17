<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>麦多系统管理</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/stylesheets/main.css">
        <link rel="stylesheet" href="/stylesheets/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.1.0/css/amazeui.min.css">
        <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
        <script src="http://cdn.amazeui.org/amazeui/2.1.0/js/amazeui.min.js"></script>
        <script src="/javascripts/customer.js"></script>
    </head>
    <body>

        <div class="login-wrapper">
            {{Form::open(array('action'=>'MerchantsController@postLogin'))}}
               <div class="am-alert  am-alert-secondary"  style="display: {{$errors->first() ? 'block':'none'}}" >
                    <button type="button" class="am-close">&times;</button>
                    <p>{{$errors->first()}}</p>
                </div>
                <div class="am-input-group ">
                  <span class="am-input-group-label"><i class="am-icon-user"></i></span>
                  {{Form::text('mobile','',array('id'=>'phone-input','class'=>'am-form-field phone-input','placeholder'=>'请输入手机号码'))}}
                </div>

                <div class="am-input-group">
                  <span class="am-input-group-label"><i class="am-icon-lock"></i></span>
                  {{Form::password('password',array('id'=>'pwd-input','class'=>'am-form-field','placeholder'=>'请输入密码','autocomplete'=>'off'))}}
                </div>

                <input type="submit" class="am-btn am-btn-primary  am-btn-block" value="登录"/>
                <a href="{{URL::route('merchants.register')}}" class="am-btn am-btn-default am-btn-block">注册</a>
            {{Form::close()}}
        </div>

    </body>
</html>
