<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>麦多系统管理</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/stylesheets/main.css">
        <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
        <script src="/javascripts/customer.js"></script>
    </head>
    <body>

        <div class="login-wrapper">
            <div class="logo">
                <a href="#"><img src="/images/mikudingzhi2.png" /></a>
                <b>登录</b>
            </div>
            <div style="clear:both;"></div>
            <div class="login-form">
                {{Form::open(array('url'=>URL::route('admin.login')))}}
                <table>
                    <tr>
                        <td></td>
                        <td><span class="form-tip">{{$errors->first()}}</span></td>
                    </tr>
                    <tr>
                        <td>手机号码:</td>
                        <td>{{Form::text('admin[mobile]','13138656869',array('id'=>'phone-input','class'=>'txt-input','placeholder'=>'请输入手机号码'))}}</td>
                    </tr>
                    <tr>
                        <td>登录密码:</td>
                        <td>{{Form::password('admin[password]',array('id'=>'pwd-input','class'=>'txt-input','placeholder'=>'请输入密码','autocomplete'=>'off'))}}</td>
                    </tr>
                    <tr>
                        <td>验证码:</td>
                        <td>
                            {{Form::text('admin[authcode]','',array('id'=>'code-input','class'=>'txt-input txt-code','placeholder'=>'请输入验证码','autocomplete'=>'off'))}}
                            <img alt="验证码图片" title="点击我刷新" src="{{URL::route('validate_code')}}" class="validate_img" onclick="this.src=this.src+'?'+Math.random() "/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input id="check-auto-login" class="checkbox check-auto-login" type="checkbox" name="admin[auto_login]"> <span class="check-label">三天内免登录</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" class="btn-submit" value="登录"></td>
                    </tr>
                </table>
                {{Form::close()}}
            </div>

        </div>

    </body>
</html>
