@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
@include('images._search_bar')
@include('images._action_bar')
<ul class="thumbnail-list">
    @foreach($image_folders as $folder)
        <li class="thumbnail">
            <a href="{{ URL::route('site-images.index', ['folder_id'=>$folder->id]) }}">
                {{ HTML::image('images/folder.png') }}
            </a>
            <div class="caption">
                <label for="">{{{ $folder->name }}} (共{{ $folder->images_count }}张)</label>
            </div>
        </li>
    @endforeach

    @foreach($images as $image)
        <li class="thumbnail">
            {{ HTML::image($image->url) }}
            <div class="caption">
                <label for="">{{{ $image->name }}}</label>
            </div>
        </li>
    @endforeach
</ul>
@include('images._action_bar')
@stop