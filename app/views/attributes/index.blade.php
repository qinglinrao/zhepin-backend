@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    @include('attributes._search_bar')
    <div class="data-warp">
        @include('attributes._action_bar')
        <div class="table-warp">
            <table class="table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>创建时间</th>
                    <th>名称</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attributes as $attribute)
                    <tr>
                        <td>{{ $attribute->id }}</td>
                        <td>{{ $attribute->created_at }}</td>
                        <td>{{{ $attribute->name }}}</td>
                        <td>{{{ $attribute->note }}}</td>
                        <td>
                            {{ HTML::linkRoute('attributes.destroy', '删除', ['id'=>$attribute->id], ['class'=>'destroy']) }} | {{ HTML::linkRoute('attributes.edit', '编辑', ['id'=>$attribute->id]) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop