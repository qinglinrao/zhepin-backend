@extends('layouts/interface')

@include('layouts.sidebar.profit')

@section('main')
    <div class="data-list">
        <h4>创建代理商</h4>
         {{Form::open(array('url'=>URL::route('merchants.create'),'method'=>'post','style'=>'width:250px;'))}}
            <div class="form-tip">{{$errors->first()}}</div>
            <div class="form-group">
                <label >手机号码</label>
                {{ Form::text('mobile', null, ['class'=>'form-control','placeholder'=>'请输入手机号码']) }}
            </div>
            <div class="form-group">
                <label >密码</label>
                {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'请输入密码']) }}
            </div>
            <input type="submit" value="确定" class="button button-primary button-small  button-block">
         {{Form::close()}}
    </div>
@stop
