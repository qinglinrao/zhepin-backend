@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    @include('product-services._search_bar')
    <div class="data-warp">
        @include('product-services._action_bar')
        <div class="table-warp">
            <table class="table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>创建时间</th>
                    <th>标签名称</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->created_at }}</td>
                        <td>{{{ $service->name }}}</td>
                        <td>{{{ $service->note }}}</td>
                        <td>
                            {{ HTML::linkRoute('product-services.destroy', '删除', ['id'=>$service->id], ['class'=>'destroy']) }} | {{ HTML::linkRoute('product-services.edit', '编辑', ['id'=>$service->id]) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop