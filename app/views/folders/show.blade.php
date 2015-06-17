@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('main')
    @include('folders._search_bar')
    @include('folders._action_bar')
    <ul class="thumbnail-list">
        @foreach($folder->products as $product)
            <li class="thumbnail">
                <label for="product-{{ $product->id }}">
                    {{ HTML::image($product->thumb->url) }}
                    <div class="caption">
                        <label>
                            <input type="checkbox"> {{{ $product->name }}}
                        </label>
                    </div>
                </label>
            </li>
        @endforeach
    </ul>
@stop