@extends('layouts/interface')

@include('layouts.sidebar.profit')

@section('main')
<div class="source-library">

    <div class="add-source">
        <h4 class="data-title">素材库/上传素材</h4>
        {{Form::open(array('url'=>URL::route('sources.save_source'),'class'=>'data-form'))}}
            @if($errors->first())
            <div class="alert alert-danger" role="alert">{{$errors->first()}}</div>
            @endif
            {{Form::hidden('source[source_type]',2)}}
            <div class="form-group">
                <label class="form-label">
                   文章标题 <em></em>
                </label>
                {{Form::text('source[title]',null,['class'=>'form-input'])}}
            </div>
            <div class="form-group">
                <label class="form-label">
                   作者 <em>(选填)</em>
                </label>
                {{Form::text('source[author]',null,['class'=>'form-input'])}}
            </div>
            <div class="form-group">
                <label class="form-label">封面 <em>(大图片建议 900像素*500像素)</em></label>
                <div class="form-file">
                    <button>上传图片</button>
                    <input type="file" name="photo" id="source-image">
                    {{Form::hidden('source[image_id]',null)}}
                </div>
                {{--<div class="form-checkbox">--}}
                    {{--<input type="checkbox" >--}}
                    {{--<label class="for-checkbox">封面图片显示在正文中</label>--}}
                {{--</div>--}}
            </div>
            <div class="form-group">
                <label class="form-label">摘要 <em>(选填)</em></label>
                {{Form::textarea('source[summary]',null,['class'=>'form-textarea'])}}
            </div>
            <div class="form-group">
                <label class="form-label">正文</label>
                {{--{{ Umeditor::content('',['id'=>'myEditor','name'=>'source[content]']) }}--}}
                {{Form::textarea('source[content]',null,['class'=>'form-textarea editor'])}}
            </div>
            <div class="form-group">
                <input type="submit" value="保存"  class="form-submit">
            </div>

        {{Form::close()}}
    </div>

</div>
@stop