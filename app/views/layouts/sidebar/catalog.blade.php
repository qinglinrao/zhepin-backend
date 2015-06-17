@section('sidebar')
<div class="catalog-menu menu-item">
  <a class="setup-button" href="{{ URL::route('products.create') }}" >发布商品</a>
  <ul>
    <li class="{{ Active::path('products/online') }}">
      <a href="{{ URL::route('products.status', ['status'=>'online']) }}">在售商品</a>
    </li>
    {{--<li class="{{ Active::path('site-images') }}">--}}
      {{--<a href="{{ URL::route('site-images.index') }}">图片相册</a>--}}
    {{--</li>--}}
    {{--<li class="{{ Active::path('folders') }}">--}}
      {{--<a href="{{ URL::route('folders.index') }}">商品文件夹</a>--}}
    {{--</li>--}}
    <li class="{{ Active::path('products/offline') }}">
      <a href="{{ URL::route('products.status', ['status'=>'offline']) }}">后院仓库</a>
    </li>
  </ul>
  <ul>
    <li class="{{ Active::path('categories') }}">
      <a href="{{ URL::route('categories.index') }}">商品分类</a>
    </li>
    <li class="{{ Active::path('product-services') }}">
      <a href="{{ URL::route('product-services.index') }}">商品标签</a>
    </li>
    {{--<li class="{{ Active::path('attribute-sets') }}">--}}
      {{--<a href="{{ URL::route('attribute-sets.index') }}">商品属性组</a>--}}
    {{--</li>--}}
    {{--<li class="{{ Active::path('attributes') }}">--}}
      {{--<a href="{{ URL::route('attributes.index') }}">商品属性</a>--}}
    {{--</li>--}}
    <li class="{{ Active::path('options') }}">
      <a href="{{ URL::route('options.index') }}">商品规格</a>
    </li>
     {{--<li class="{{ Active::path('profit') }}">--}}
      {{--<a href="{{ URL::route('profit.index') }}">分润配置</a>--}}
    {{--</li>--}}
  </ul>
</div>
@stop