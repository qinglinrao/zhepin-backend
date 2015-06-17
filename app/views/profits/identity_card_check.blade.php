<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        {{ HTML::script('javascripts/bower_components/jquery/dist/jquery.js') }}
        <script>
            $(function(){
                var cur =    0;
                $('a.up_one,a.next_one').click(function(){
                    cur = 1-cur;
                    $('ul li').hide();
                    $('ul li').eq(cur).show();
                })
            })
        </script>
    </head>
    <style>

        .identity_card img{
          max-width: 640px;
          min-width: 320px;
          margin-bottom: 5px;
          border:1px solid #ccc;
          text-align: center;
          vertical-align: middle;
          max-height: 350px;
          margin:0 auto;
          display: block;
        }
        .identity_card ul{
            margin:0;
            padding:0;

        }
        .identity_card ul li{


        }
        .identity_card ul li h4{
            text-align: center;
            height:25px;
            line-height: 25px;
            margin:0;
            padding:0;
        }
        .identity_card ul li:first-child{
            display: none;
        }
        .identity_card a{
            color:#aaa;
            position: absolute;
            top:5px;
            font-weight: bolder;
            text-decoration: none;
        }
        .identity_card a.up_one{
            left:20px;
        }
        .identity_card a.next_one{
            right:20px;
        }
        .identity_card{
         max-width:640px;
         height:auto;
         overflow: hidden;
         position: relative;
        }
    </style>
    <body>
        <div class="identity_card">
            <ul>
                <li>
                    <h4>正面照</h4>
                    <img src="{{$account_log->upCoverImage?AppHelper::imgSrc($account_log->upCoverImage->url):''}}" alt="身份证正面照显示错误或用户没上传" title="正面照"/>

                </li>
                <li>
                    <h4>反面照</h4>
                    <img src="{{$account_log->down_cover_image ?AppHelper::imgSrc($account_log->down_cover_image->url):''}}" alt="身份证反面照显示错误或用户没上传" title="反面照"/>
                </li>
            </ul>
            <a href="javascript:void(0)" class="up_one"><</a>
            <a href="javascript:void(0)" class="next_one">></a>

        </div>
    </body>
</html>