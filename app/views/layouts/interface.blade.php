<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>哲品后台管理</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/javascripts/bower_components/bootstrap/dist/css/bootstrap.css">
    {{--<link rel="stylesheet" href="http://www.bootcss.com/p/buttons/css/buttons.css"/>--}}
    <link rel="stylesheet" href="/stylesheets/buttons.css"/>
    <link rel="stylesheet" href="/stylesheets/main.css">
    <link rel="stylesheet" href="/javascripts/bower_components/datetimepicker/jquery.datetimepicker.css">
    <link rel="stylesheet" href="/javascripts/bower_components/blueimp-file-upload/css/jquery.fileupload.css">
     <link rel="stylesheet" href="/stylesheets/imageZoom.css"/>
    @yield('style')
    <script type="text/javascript">
        var mcmore = {
            site_url: 'http://192.168.0.41:8088'
        }

        var image_site = 'http://localhost:8089';
    </script>
</head>
<body ng-app="mcmoreApp">

<header>
    <div class="container">
        <div class="logo">
            <a href="{{ Config::get('app.url') }}">
                {{ HTML::image('images/mikudingzhi.png') }}
            </a>
        </div>
        <ul class="main-nav">
            <li class="{{ Active::path('orders') }}">
                <a href="{{ URL::route('orders.index') }}">
                    <span class="icon icon-order"></span>订单
                </a>
            </li>
            <li class="{{ Active::path('products*')}}">
                <a href="{{ URL::route('products.index') }}">
                    <span class="icon icon-catalog"></span>商品
                </a>
            </li>
            <li class="{{ Active::path('customers') }}">
                <a href="{{URL::route('customers.index')}}">
                    <span class="icon icon-customer"></span>会员
                </a>
            </li>

            <li>
                <a href="{{URL::route('account_log')}}">
                    <span class="icon icon-data"></span>提现
                </a>
            </li>
            <li>
                <a href="{{ URL::route('profit.merchants',array('type'=>'1')) }}">
                    <span class="icon icon-activity"></span>分润
                </a>
            </li>
            <li>
                <a href="{{URL::route('other.banners')}}">
                    <span class="icon icon-app"></span>促销
                </a>
            </li>
            {{--<li>--}}
                {{--<a href="{{URL::route('logout')}}">--}}
                    {{--<span class="icon icon-data"></span>--}}
                    {{--退出--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
        <div class="login-inf">
        	<a href="#" class="head-portrait">
        	   <img src="/images/head-portrait.jpg">
        	</a>
        	<a href="#" class="login-account">管理员({{Auth::user()->email?Auth::user()->email:Auth::user()->mobile}})</a>
        	<span class="drop-down" >
        	    <b></b>
                <ul class="button-dropdown-list">
                    <li><a href="#">个人设置</a></li>
                    <li><a href="#">修改密码</a></li>
                    <li class="button-dropdown-divider">
                        <a href="{{URL::route('logout')}}" onclick="return confirm('您确定要退出系统吗?')">退出系统</a>
                    </li>
                </ul>
        	</span>
        </div>
    </div>
</header>

<div class="container">
    <div class="sidebar">
        @yield('sidebar')
    </div>
    <div class="main">
        @yield('main')
    </div>
</div> <!-- /container -->

<footer>
    <div class="container">
        <p><a href="#">关于麦多</a> 丨 <a href="#">帮助中心</a> 丨 <a href="#">意见反馈</a> 丨 <a href="#">联系客服</a></p>
        <p>Copyright&copy2013-2014 广州市麦多信息科技有限公司 All Rights Reserved 版权所有 粤ICP备14069075号-1</p>
    </div>
</footer>

<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>

{{ HTML::script('javascripts/bower_components/lodash/dist/lodash.min.js') }}
{{ HTML::script('javascripts/bower_components/jquery/dist/jquery.js') }}
{{ HTML::script('javascripts/bower_components/ckeditor/ckeditor.js') }}
{{ HTML::script('javascripts/bower_components/ckeditor/adapters/jquery.js') }}
{{ HTML::script('javascripts/masonry.pkgd.min.js') }}
{{ HTML::script('javascripts/uploadPreview.js') }}
{{ HTML::script('javascripts/bower_components/datetimepicker/jquery.datetimepicker.js') }}

<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


{{ HTML::script('javascripts/bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js') }}
{{ HTML::script('javascripts/bower_components/blueimp-file-upload/js/jquery.iframe-transport.js') }}
{{ HTML::script('javascripts/bower_components/blueimp-file-upload/js/jquery.fileupload.js') }}
{{ HTML::script('javascripts/imageZoom.js') }}
{{ HTML::script('javascripts/main.js') }}
{{ HTML::script('javascripts/bower_components/angular/angular.js') }}
{{ HTML::script('javascripts/bower_components/angular-resource/angular-resource.js') }}
{{ HTML::script('javascripts/bower_components/angular-bootstrap/ui-bootstrap.js') }}
{{ HTML::script('javascripts/bower_components/angular-bootstrap/ui-bootstrap-tpls.js') }}
{{ HTML::script('javascripts/app.js') }}
{{ HTML::script('javascripts/services/product_folder.js') }}
{{ HTML::script('javascripts/controllers/product.js') }}
{{ HTML::script('javascripts/directives/parameter.js') }}


@yield('scripts')

</body>
</html>