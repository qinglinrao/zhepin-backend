@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    @include('attribute-sets._search_bar')
    <div class="data-warp">
        @include('attribute-sets._action_bar')
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
                @foreach($attribute_sets as $attribute_set)
                    <tr>
                        <td>{{ $attribute_set->id }}</td>
                        <td>{{ $attribute_set->created_at }}</td>
                        <td>{{{ $attribute_set->name }}}</td>
                        <td>{{{ $attribute_set->note }}}</td>
                        <td>
                            {{ HTML::linkRoute('attribute-sets.destroy', '删除', ['id'=>$attribute_set->id], ['class'=>'destroy']) }} | {{ HTML::linkRoute('attribute-sets.edit', '编辑', ['id'=>$attribute_set->id]) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop