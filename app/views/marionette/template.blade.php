<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>麦多系统</title>
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

      page: {
        itemList: [],
        pageElement: []
      },

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
<body>
<div id="main-wrapper" class="clearfix">
  <div id="header-wrapper">
    <div id="header">
      <div id="logo"><img src="/marionette/images/logo.png"/></div>
      <div id="select-wrapper">
        <select name="industry" class="select-field" id="industry-list">
          @foreach($industries as $industry)
            <option value="{{$industry->id}}">{{$industry->name}}</option>
          @endforeach
        </select>
        <select name="theme" class="select-field" id="theme-list">
          <option value="0">选择风格</option>
          @foreach($industries as $industry)
            @foreach($industry->themes as $theme)
              <option class="list" value="{{$theme->code}}" data-industry="{{$industry->id}}">{{$theme->name}}</option>
            @endforeach
          @endforeach
        </select>
      </div>
      <div id="right-menu-wrapper">
        <ul class="list-unstyled list-inline">
          <li>
            <span>
              <form id="image-upload" action = "{{URL::route('image.upload')}}" method="post" enctype="multipart/form-data">
                <input type="file" name="tpl_thumb" class="select-filed"/>
              </form>
            </span>
          </li>
          <li><span>
              模板名：<input id="template-name" type="text" name="template_name"/>
              <input id="page-id" type="hidden" name ="page_id" value=""/>
            </span>
          </li>
          <li><span id="save-template">保存模板</span></li>
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
          <div id="preview-region">

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
</body>
</html>