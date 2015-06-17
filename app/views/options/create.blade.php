@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    {{ Form::open(['route'=>'options.store']) }}
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

            </tbody>
        </table>
    </fieldset>

    <div class="action-buttons">
        {{ HTML::linkRoute('categories.index', '取消', null, ['class'=>'btn btn-default']) }}
        {{ Form::submit('新增', ['class'=>'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
@stop