@extends('layouts/interface')

@include('layouts.sidebar.other')

@section('main')

<div class="banner">
    @foreach($banners as $key => $banner)
    <div class="edit-form">
        {{Form::open(array('url'=>URL::route('other.update_banner'),'files'=>true))}}
            {{Form::hidden('banner_id',$banner->id)}}
            <table>
                <tr><td colspan="3"><h4>广告图{{['一','二','三','四','五','六','七','八','九'][$key]}}</h4></td></tr>
                <tr>
                    <td width="90">跳转路径 </td>
                    <td width="690" class="url-td">
                        {{Form::text('url',$banner->url,array('class'=>'banner_input'))}}
                        {{Form::hidden('type','2')}}

                     </td>
                    <td rowspan="4">
                        @if($banner->image)
                        <img src="{{$banner->image?AppHelper::imgSrc($banner->image->url):''}}" width="200" class="banner_image"/>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td >标题 </td>
                    <td>
                        {{Form::text('title',$banner->title,array('class'=>'title_input','placeholder'=>'请输入标题'))}}
                    </td>
                </tr>
                <tr>
                    <td >广告图 </td>
                    <td>
                        {{Form::file('image')}}(最佳尺寸640X280)
                        <div class="preview-banner-image">

                        </div>
                    </td>
                </tr>
                <tr><td><input type="submit" value="提交"></td></tr>
            </table>
       {{Form::close()}}
    </div>
    @endforeach
</div>

@stop