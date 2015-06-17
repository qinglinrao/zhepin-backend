@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    {{ Form::model($option, ['method'=>'PATCH', 'route'=>['options.update', $option->id]]) }}
    <fieldset>
        <legend>基本信息</legend>
        <table class="table edit-table">
            <tbody>
            <tr>
                <th class="field">名称:</th>
                <td>{{ Form::text('name', null, ['class'=>'form-control'])  }}</td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset id="option-values">
        <legend>选项值</legend>
        {{ Form::button('<span class="glyphicon glyphicon-plus"></span> 增加</a>', ['class'=>'btn btn-primary', 'id'=>'add-option']) }}
        <table class="table">
            <tbody>
            @foreach($option->values as $value)
                <tr>
                    <td>
                        {{ Form::text('values['.$value->id.'][name]', $value->name, ['class'=>'form-control']) }}
                    </td>
                    <td>
                        <a class="destroy-option" href="javascript:void(0)">移除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </fieldset>

    <div class="action">
        {{ HTML::linkRoute('categories.index', '返回', null, ['class'=>'btn btn-default']) }}
        {{ Form::submit('Submit!', ['class'=>'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
@stop