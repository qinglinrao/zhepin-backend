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

        <div class="register-wrapper">
            {{Form::open(array('action'=>'MerchantsController@postRegister'))}}
                <div class="am-alert  am-alert-secondary"  style="display: {{$errors->first() ? 'block':'none'}}" >
                    <button type="button" class="am-close">&times;</button>
                    <p>{{$errors->first()}}</p>
                </div>

                <div class="step1">
                    <div class="am-input-group ">
                      <span class="am-input-group-label"><i class="am-icon-mobile am-icon-sm"></i></span>
                      {{Form::text('mobile','',array('id'=>'phone-input','class'=>'am-form-field phone-input','placeholder'=>'请输入手机号码'))}}
                    </div>
                    {{--<button  class="am-btn am-btn-primary  am-btn-block" >下一步</button>--}}
                </div>
                <div class="step2">

                    <div class="am-input-group ">
                          {{Form::text('authcode','',array('id'=>'code-input','class'=>'am-form-field check-code','placeholder'=>'验证码'))}}
                          <button class="am-btn am-btn-primary get-code"  >获取验证码</button>
                    </div>
                    <div class="am-input-group ">
                      <span class="am-input-group-label"><i class="am-icon-lock"></i></span>
                      {{Form::password('password',array('id'=>'pwd-input','class'=>'am-form-field','placeholder'=>'请设置您的密码','autocomplete'=>'off'))}}
                    </div>
                    <div class="am-input-group ">
                      <span class="am-input-group-label"><i class="am-icon-lock"></i></span>
                      {{Form::password('repassword',array('id'=>'repwd-input','class'=>'am-form-field','placeholder'=>'确认密码','autocomplete'=>'off','data-equal-to'=>'#pwd-input'))}}
                    </div>
                    <div class="am-input-group">
                        <span class="am-input-group-label industry-icon"><i class="am-icon-newspaper-o"></i></span>
                        <select data-am-selected="{dropUp: 1}" id="industry_select" name="industry">
                          <option value="">---请选择您所经营的行业---</option>
                          @foreach($industries as $industry)
                          <option value="{{$industry['id']}}">{{$industry['name']}}</option>
                          @endforeach

                        </select>
                     </div>
                    <button  class="am-btn am-btn-primary  am-btn-block" >完成注册</button>
                </div>
            {{Form::close()}}

        </div>

    </body>
</html>
