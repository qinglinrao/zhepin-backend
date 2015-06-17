@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    <div class="title-prompt">商品属性：显示在具体商品的购买页面中，一般在商品图片的右侧，商品名称正面。商品属性，应该是商品特有的重要属性，是可供用户挑选的属性。（一般包含：颜色、尺码）</div>
    <div class="data-list">
        <div class="table-warp">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>属性名称</th>
                    <th>商品属性内容</th>
                    <th class="operation">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($options as $option)
                    <tr>
                        <td>
                            {{ $option->name }}
                        </td>
                        <td>
                            @foreach($option->values as $value)
                                <span class="label label-default">{{ $value->name }}</span>
                            @endforeach
                        </td>
                        <td class="operation">
                            {{ HTML::linkRoute('options.destroy', '删除', ['id'=>$option->id], ['class'=>'destroy']) }} |
                            {{ HTML::linkRoute('options.edit', '编辑', ['id'=>$option->id]) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('options._action_bar')
@stop