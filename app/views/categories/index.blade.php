@extends('layouts/interface')

@include('layouts.sidebar.catalog')
@section('style')
<link rel="stylesheet" href="/stylesheets/imageZoom.css"/>
@stop
@section('main')
@include('categories._search_bar')
<div class="data-list">
    @include('categories._action_bar')
    <div class="table-warp">
        <table class="table">
            <thead>
            <tr>
                {{--<th></th>--}}
                <th class="text-left">分类名称</th>
                <th>分类图片</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($category_roots as $category_root)
            <tr>
                {{--<td><input type="checkbox" name="ids[]" class="ids" /></td>--}}
                <td class="category-column"><span class="category-name">{{{ $category_root->name }}}</span></td>
                <td></td>
                <td>{{ $category_root->created_at }}</td>
                <td class="operation">
                    {{ HTML::linkRoute('categories.destroy', '删除', ['id'=>$category_root->id], ['class'=>'destroy']) }} | {{ HTML::linkRoute('categories.edit', '编辑', ['id'=>$category_root->id]) }}
                </td>
            </tr>
                @if(!$query)
                @foreach($category_root->children as $category)
                    <tr class="">
                        {{--<td><input type="checkbox" name="ids[]" class="ids" /></td>--}}
                        <td class="category-column children-column"><span class="category-name">{{{ $category->name }}}</span></td>
                        <td>
                            {{--<a class="add-photo" href="#">添加图片</a>--}}
                            @if($category->image)
                            <img src="{{$category->image?AppHelper::imgSrc($category->image->url):''}}" width="50" class="categroy-image"/>
                            @endif
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td class="operation">
                            {{ HTML::linkRoute('categories.destroy', '删除', ['id'=>$category->id], ['class'=>'destroy']) }} | {{ HTML::linkRoute('categories.edit', '编辑', ['id'=>$category->id]) }}
                        </td>
                    </tr>
                @endforeach
                @endif
            {{--<tr>--}}
                {{--<td></td>--}}
                {{--<td class="category-column children-column"><a class="add-category" href="#">添加子分类</a></td>--}}
                {{--<td colspan="5"></td>--}}
            {{--</tr>--}}
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop