@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    {{ Form::open(['route'=>'categories.store']) }}
    <table class="table edit-table">
        <tbody>
        <tr>
            <th>{{ Form::label('name', '分类名称:') }}</th>
            <td>
                {{ Form::text('name', null, ['class'=>'form-control']) }}
            </td>
        </tr>
        <tr>
            <th>{{ Form::label('parent_id', '所属分类:') }}</th>
            <td>
                {{ CategoryHelper::roots() }}
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                {{ HTML::linkRoute('categories.index', '返回', null, ['class'=>'btn btn-default']) }}
                {{ Form::submit('保存', ['class'=>'btn btn-primary']) }}
            </td>
        </tr>
        </tbody>
    </table>
@stop