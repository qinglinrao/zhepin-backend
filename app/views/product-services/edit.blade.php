@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    {{ Form::model($service, ['method'=>'PATCH', 'route'=>['product-services.update', $service->id]]) }}
    <table class="table edit-table">
        <tbody>
        <tr>
            <th>{{ Form::label('name', '名称:') }}</th>
            <td>
                {{ Form::text('name', null, ['class'=>'form-control']) }}
            </td>
        </tr>
        <tr>
            <th>{{ Form::label('note', '备注:') }}</th>
            <td>
                {{ Form::text('note', null, ['class'=>'form-control']) }}
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                {{ HTML::linkRoute('product-services.index', '返回', null, ['class'=>'btn btn-default']) }}
                {{ Form::submit('Submit!', ['class'=>'btn btn-primary']) }}
            </td>
        </tr>
        </tbody>
    </table>
@stop