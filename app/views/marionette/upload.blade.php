<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>图片上传</title>
  <style type="text/css" rel="stylesheet">
    .bar {
      height: 18px;
      background: #30cab2;
    }
    body{
      margin: 0;
    }
    #submit{
      display: none;
      background-color: #30cab2;
      border-radius: 5px;
      position: fixed;
      width: 150px;
      height: 30px;
      border:none;
      cursor: pointer;
      font-size: 20px;
      color: #fff;;
      padding: 0;
      bottom: 10px;
      left: 50%;
      margin-left: -75px;
      z-index: 999;
    }
    .fileupload-wrapper{
      background-color: #30cab2;
      border-radius: 5px;
      position: relative;
      width: 150px;
      height: 30px;
      overflow: hidden;
      margin-bottom: 10px;
    }
    .fileupload-wrapper .text{
      position: absolute;
      right: 0;
      top: 0;
      color: #fff;
      font-size: 20px;
      line-height: 34px;
      width: 150px;
      text-align: center;
      display: block;
    }
    .fileupload-wrapper #fileupload{
      font-size: 100px;
      position: absolute;
      right: 0;
      top: 0;
    }
  </style>
  {{HTML::style('marionette/bower_components/jcrop/css/jquery.Jcrop.min.css')}}
</head>
<body>
<div class="fileupload-wrapper">
  <span class="text">选择图片</span>
  <input id="fileupload" type="file" name="{{Input::get('name')}}" data-url="/image-upload" multiple>
</div>
<div id="progress">
  <div class="bar" style="width: 0%;"></div>
</div>
<div id="uploaded-image">

</div>
<form class="crop-form">
  <input type="hidden" id ="file-name" name="file_name" value=""/>
  <input type="hidden" id ="x" name="x" value=""/>
  <input type="hidden" id ="y" name="y" value=""/>
  <input type="hidden" id ="w" name="w" value=""/>
  <input type="hidden" id ="h" name="h" value=""/>
  <input type="button" id="submit"  value="提交"/>
</form>
{{HTML::script('marionette/bower_components/jquery/dist/jquery.min.js')}}
{{HTML::script('marionette/bower_components/jqueryUpload/jquery.ui.widget.js')}}
{{HTML::script('marionette/bower_components/jqueryUpload/jquery.iframe-transport.js')}}
{{HTML::script('marionette/bower_components/jqueryUpload/jquery.fileupload.js')}}
{{HTML::script('marionette/bower_components/jcrop/js/jquery.Jcrop.min.js')}}
<script>
  $(function() {

    $('#fileupload').fileupload({
      dataType: 'json',
      progressall: function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').show().css(
            'width',
            progress + '%'
        ).text(progress + '%');
      },
      done: function(e, data) {
        var result = data.result
        if(result.state == 1) {
          $('#progress .bar, .fileupload-wrapper').fadeOut();
          $('#file-name').val(result.url);
          $('<img style="width:640px; height:auto" src="'+result.url+'"/>').appendTo($('#uploaded-image')).Jcrop({
            allowSelect: false,
            minSize: 0,
            maxSize: [640, 280],
            {{Input::get('name') == 'logo' ? '' :'aspectRatio: 16 / 7,'}}
            setSelect: [0, 0, 320, 140],
            onSelect: function (c) {
              $('#x').val(c.x)
              $('#y').val(c.y)
              $('#w').val(c.w)
              $('#h').val(c.h)
            }
          }, function () {
            var c = this.tellSelect()
            $('#x').val(c.x)
            $('#y').val(c.y)
            $('#w').val(c.w)
            $('#h').val(c.h)
            $('#submit').show()
          });
        }else{
          alert(result.msg);
        }
      }
    });

    $('#submit').click(function() {
      $.ajax({
        url: '/image-resize',
        data: $('.crop-form').serialize(),
        dataType: 'json',
        type: 'post',
        success: function(result) {
          if(result.state == 1){
            window.parent.$.fancybox.close()
            window.parent.McMore.uploadImageCallback(result)
          }else{
            alert(result.msg)
          }

        }
      });
      return false;
    })
  });
</script>
</body>
</html>