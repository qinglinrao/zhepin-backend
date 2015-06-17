<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>麦多系统</title>
  {{HTML::style('marionette/css/bootstrap.min.css')}}
  {{HTML::style('marionette/css/layout.css')}}
  <style>
    body{
      background-color: #fff;
    }
  </style>
</head>
<body>
  <div id="main-wrapper" class="products-select">
    <div id="filter-wrapper">
      <form id="filter-form" method="get" action="">
        <table>
          <tr>
            <td>商品编号:{{Form::text('sku',Input::get('sku'))}}</td>
            <td>商品名称:{{Form::text('name',Input::get('name'))}}</td>
            <td>所属分类:{{Form::select('category_id',$catArray,Input::get('category_id'))}}</td>
            <td>
              {{Form::submit('查询',['class'=>'submit-field'])}}
              <a href="{{URL::route('products.select')}}" class="reset">重置</a>
            </td>
          </tr>
        </table>
      </form>
    </div>
    <div id="data-wrapper">
      <table class="data-table table-bordered table-responsive">
        <tr>
          <th>{{Form::checkbox('all',1,'',['id'=>'check-all'])}}全选</th>
          <th>商品图片</th>
          <th>商品编号</th>
          <th>商品名称</th>
          <th>所属分类</th>
          <th>售价</th>
          <th>库存</th>
          <th>状态</th>
        </tr>
        @foreach($products as $p)
          <tr class="data">
            <td width="80px">{{in_array($p->id,$pIds) ? '已添加' : Form::checkbox('pIds[]', $p->id,'',['class'=>'item']) }}</td>
            <td><img width="60" height="60" src="{{$p->thumb->url}}"/></td>
            <td>{{$p->sku}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->category->parent->name.'-'.$p->category->name}}</td>
            <td>{{$p->sale_price}}</td>
            <td>{{$p->stock}}</td>
            <td>{{$p->visible}}</td>
          </tr>
        @endforeach
      </table>
    </div>
    <div id="operation-wrapper" class="clearfix">
      <div class="buttons">
        <ul class="list-unstyled list-inline">
          {{--<li><span class="cancel">取消</span></li>--}}
          <li><span class="add">添加</span></li>
          <li>【小提示】在进入下一页面之前，请先点击添加按钮将本页选择的商品添加进组件。</li>
        </ul>
      </div>
      <div class="pagination-wrapper">
        {{$products->links()}}
      </div>
    </div>
  </div>
  {{HTML::script('marionette/bower_components/jquery/dist/jquery.min.js')}}
  <script>
    (function($){
      $(document).ready(function(){
        //全选
        $("#check-all").click(function(){
          $(".item").prop("checked",$(this).prop("checked"));
        });

        //添加商品进组件

        $('span.add').click(function(){
          var data = [];
          $('.item').each(function(){
            if($(this).prop("checked")){
              data.push($(this).val())
            }
          });

          if(data.length == 0) return;
          $.ajax({
            url: 'products-select/add',
            data:{pIds:data},
            dataType : 'json',
            type: 'post',
            success:function(result){
              if(window.parent.McMore.selectProductsCallback(result)){
                alert('商品添加成功')
              }
            }
          })
        })
      })
    })(jQuery)
  </script>
</body>
</html>