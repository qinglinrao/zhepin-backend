@section('sidebar')
<div class="catalog-menu menu-item">
  <ul>
    <li class="{{ Active::path('other/banners') }}">
      <a href="{{ URL::route('other.banners') }}">首页轮播图</a>
    </li>
    <li class="{{ Active::path('other/ads') }}">
      <a href="{{ URL::route('other.ads') }}">广告促销</a>
    </li>

  </ul>

</div>
@stop