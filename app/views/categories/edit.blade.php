@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    {{ Form::model($category, ['method'=>'PATCH', 'route'=>['categories.update', $category->id]]) }}
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
                {{ CategoryHelper::roots($category->parent_id, $category) }}
            </td>
        </tr>
        <tr>
            <th>
                缩略图
            </th>
            <td>
                <input type="file" name="image_id" category_id="{{$category->id}}"  id="upload_category_image" />
                <div class="category_image_priview">
                    @if($category->image)
                    <img src="{{$category->image?AppHelper::imgSrc($category->image->url):''}}" width="140">
                    @endif
                </div>
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
    {{ Form::close() }}
@stop