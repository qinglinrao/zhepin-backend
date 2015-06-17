@extends('layouts/interface')

@section('scripts')
<script>
    $(function(){
        new uploadPreview({ UpBtn: "upload-image-source-input", DivShow: "imageList",ImgClass:"imageclass",DivFile:"fileList",FileInput:"fileinput",FileName:"picture_file[]",MaxSize:10 });
    })
</script>
@stop

@include('layouts.sidebar.profit')

@section('main')
    <div class="data-list source-library" >
        <div class="table-warp">
            {{Form::open(array('url'=>URL::route('sources.list'),'class'=>'data-form search-sources','method'=>'get'))}}
                {{Form::text('query',$query,['class'=>'form-control','placeholder'=>'请输入关键字进行搜索'])}}
                {{Form::hidden('type',$type)}}
                <button type="submit" class="btn btn-default">搜索</button>
            {{Form::close()}}
            <div class="show-by-type">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    全部分类
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::route('sources.list',['type'=>2])}}">文章</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{URL::route('sources.list',['type'=>1])}}">图片</a></li>
                  </ul>
                </div>
            </div>
        </div>

        <div class="source-list">
            <ul>
                <li class="add-li">
                   <div class="li-text">
                    + 添加素材
                   </div>
                    <div class="add-link">
                        <a href="{{URL::route('sources.add_article')}}">文章</a>
                        <a href="javascript:void(0)" onclick=" $('.upload-image-source').show()">图片</a>
                    </div>
                </li>
                @foreach($sources as $source)
                <li class="source">
                    <img class="source-image" src="{{$source->image?$source->image->url:''}}">
                    <p class="title">{{$source->title}}</p>
                    <a href="{{URL::route('sources.delete_source',['id'=>$source->id])}}" class="delete" onclick="return confirm('您确定要删除吗？')">删除</a>
                    {{--@if($source->source_type == 2)--}}
                        <a href="{{URL::route('sources.edit_source',['id'=>$source->id])}}" class="edit">编辑</a>
                    {{--@endif--}}
                </li>
                @endforeach
            </ul>
        </div>

        <div class="upload-image-source">
            <h4 class="title">
                上传图片
                <span class="close" onclick=" $('.upload-image-source').hide()">X</span>
            </h4>
            {{Form::open(['url'=>URL::route('sources.add_picture'),'files' => true])}}
            <div class="file-area">
                <div id="imageList">

                </div>
                <div id="fileList">

                </div>
                <p>
                    <b>+点击添加图片</b>
                    <em>(最多可添加10张图片)</em>
                </p>
                <input type="file" name="image" id="upload-image-source-input" multiple />
            </div>
            <div class="button-group">
                <input type="submit" value="确定上传" class="btn btn-primary">
            </div>
            {{Form::close()}}
        </div>
    </div>


@stop
