<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>麦多</title>
  {{HTML::style('marionette/css/bootstrap.min.css')}}
  {{HTML::style('marionette/bower_components/fancybox/source/jquery.fancybox.css')}}
  {{HTML::style('marionette/bower_components/owl.carousel/assets/owl.carousel.css')}}
  {{HTML::style('marionette/css/layout.css')}}
  {{HTML::style('marionette/js/components/baseStyle.css')}}

  <script>

    var McMore = {
      uploadImageCallback :function(result){},
      selectProductsCallback : function(result){
        if(result.state == 1){
          $('#products-list ul').append($(result.html));
          $('.update-data').click();
        }
        return true;
      },

      page: {{json_encode($page)}},

      current_page: {{json_encode($current_page)}},

      componentDefault: {{json_encode($componentDefault)}},

      components: [{
        'id': 1,
        'title': '橱窗',
        'alias': 'products'
      },{
        'id': 2,
        'title': '搜索栏',
        'alias': 'search'
      },{
        'id': 4,
        'title': '广告图片',
        'alias': 'ads'
      },{
        'id': 5,
        'title': '幻灯片',
        'alias': 'slideshow'
      },{
        'id': 6,
        'title': '主菜单',
        'alias': 'mainmenu'
      },{
        'id': 7,
        'title': '导航栏',
        'alias': 'navigator'
      }]

    };

  </script>
  <script data-main="/marionette/js/main" src="/marionette/bower_components/requirejs/require.js"></script>
</head>
<body class="cute-01">
<div id="main-wrapper" class="clearfix">
  <div id="header-wrapper">
    <div id="header">
      <div id="logo"><img src="/marionette/images/logo.png"/></div>
      <div id="select-wrapper">
        <ul class="list-unstyled list-inline">
          <li>
            <span class="theme-label">选择风格</span>
            <ul class=" list-unstyled">
              @foreach($themes as $theme)
                <li class="theme-item {{$theme->code == $current_page->theme ? 'active' :''}}"
                    data-code="{{$theme->code}}" data-id="{{$theme->id}}">{{$theme->name}}</li>
              @endforeach
            </ul>
          </li>
          <li>
            <span>选择模板</span>
            <ul class="template list-unstyled">
              @foreach($themes as $theme)
                @foreach($theme->templates as $template)
                  <li class="template-item {{$theme->code == $current_page->theme ? '' :'hide'}}" data-id="{{$template->id}}" data-theme="{{$theme->id}}">
                    <img src="{{$template->image_url}}"/>
                  </li>
                @endforeach
              @endforeach
            </ul>
          </li>
        </ul>

      </div>
      <div id="right-menu-wrapper">
        <ul class="list-unstyled list-inline">
          <li><span id="publish-site">发布</span></li>
          <li><span id="save-preview">保存并预览</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div id="main-content" class="clearfix">
    <div class="left">
      <div class="left-top">
        <div class="block-title">
          站点地图
        </div>
        <div class="pages-list" id="page-region">
          <!--<div class="top">
              <ul class="list-unstyled list-inline">
                  <li class="action-1">添加</li>
                  <li class="action-2">上移</li>
                  <li class="action-3">下移</li>
                  <li class="action-4">删除</li>
                  <li class="action-5">搜索</li>
              </ul>
          </div>
          <div class="content" id="page_list">

          </div>-->
        </div>
      </div>
      <div class="left-bottom">
        <div class="block-title">
          部件库
        </div>
        <div class="components-list clearfix" id="component-region">

        </div>
      </div>
    </div>

    <div class="middle">
      <div class="phone-wrapper">
        <div class="phone-wrapper-inner">
          <div id="preview-region" class="{{$current_page->theme}}">

          </div>
        </div>
      </div>
    </div>

    <div class="right">
      <div class="block-title">部件属性</div>
      <div id="config-region">

      </div>
    </div>
  </div>
</div>
<div class="cover">
  <div class="cover-bg"></div>
  <div class="loading-image">
    数据正在加载中...
  </div>
</div>
</body>
</html>