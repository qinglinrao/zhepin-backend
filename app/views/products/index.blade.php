@extends('layouts/interface')

@include('layouts.sidebar.catalog')
@section('style')
<link rel="stylesheet" href="/stylesheets/imageZoom.css"/>
@stop
@section('main')
    @include('products._search_bar')
    {{ Form::open(['class'=>'form-inline', 'ng-controller'=>'ProductCtrl']) }}
    @include('products._action_bar')
    <div class="table-warp">
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>商品信息</th>
                <th>价格</th>
                <th>所属分类</th>
                <th>库存</th>
                <th>销量</th>
                <th>访问量</th>
                <th>收藏</th>
                {{--<th>所在组</th>--}}
                <th>状态</th>
                {{--<th>参加活动</th>--}}
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <input type="checkbox" id="product_{{ $product->id }}" name="id[]" class="checkbox son_checkbox" value="{{$product->id}}"/>
                    </td>
                    <td class="media">
                        <a class="media-left" href="#">
                           @if($product->thumb)
                           <img src="{{AppHelper::imgSrc($product->thumb->url)}}" width="60" height="60" />
                           @endif
                        </a>
                        <div class="media-body text-left">
                            <a href="#">{{ $product->name }}</a><br/>
                            <i>编号：<span>{{ $product->sku }}</span></i>
                        </div>
                    </td>
                    <td>
                        <span class="price price-sale">￥{{ $product->sale_price }}</span><br/>
                        <del class="price price-par">￥{{ $product->par_price }}</del>
                    </td>
                    <td>{{{ get_category_name($product) }}}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->sale_count }}</td>
                    <td>{{ $product->visit_count }}</td>
                    <td>{{ $product->collection_count }}</td>
{{--                    <td>{{ ProductHelper::render_folders($product->folders) }}</td>--}}
                    <td>
                        {{ ProductHelper::render_status($product) }}
                    </td>
                    {{--<td>--}}
                        {{--<span class="badge">折</span>--}}
                        {{--<span class="badge badge-rebate">折</span>--}}
                        {{--<span class="badge badge-grab">抢</span>--}}
                        {{--<span class="badge badge-grab">抢</span>--}}
                    {{--</td>--}}
                    <td class="operation">
                        {{ HTML::linkRoute('products.edit', '编辑', ['id'=>$product->id]) }} |
                        {{ HTML::linkRoute('products.copy', '复制', ['id'=>$product->id]) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('products._action_bar')
    {{ Form::close() }}
@stop