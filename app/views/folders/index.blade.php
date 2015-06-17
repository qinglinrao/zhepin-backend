@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    @include('folders._search_bar')
    @include('folders._action_bar')
    <ul class="thumbnail-list">
        @foreach($folders as $folder)
            <li class="thumbnail">
                <a href="{{ URL::route('folders.show', ['id'=>$folder->id]) }}">
                    {{ HTML::image('images/folder.png') }}
                </a>
                <div class="caption">
                    <label for="">{{{ $folder->name }}}</label>
                </div>
            </li>
        @endforeach
    </ul>
@stop