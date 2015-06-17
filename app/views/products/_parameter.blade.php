<div id="parameter">
    <mc-parameter product-id="{{ $product->id }}"></mc-parameter>
</div>

{{--ddd--}}
{{--<div id="parameter">--}}
    {{--@foreach($options as $option)--}}
        {{--<div class="parameter-row">--}}
            {{--<p class="parameter-name">{{ $option->name }}</p>--}}
            {{--<span class="close-icon"></span>--}}
            {{--<div class="option-row">--}}
                {{--@foreach($option->values as $value)--}}
                    {{--<div class="checkbox-inline">--}}
                        {{--<label>--}}
                            {{--<input type="checkbox" id="inlineCheckbox1" value="option1">--}}
                            {{--{{ HTML::image('images/color/brown.jpg') }}--}}
                        {{--</label>--}}
                        {{--{{ Form::text('name', $value->name) }}--}}
                    {{--</div>--}}
                {{--@endforeach--}}
                {{--<div class="checkbox">--}}
                    {{--<label>--}}
                        {{--<input type="checkbox" id="inlineCheckbox1" value="option1">--}}
                        {{--全选--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endforeach--}}
    {{--<div class="parameter-action">--}}
        {{--<input type="button" class="border-r add-parameter" value="添加规格参数"/>--}}
        {{--<a class="parameter-link td-middle" href="#">管理商品规格模板</a>--}}
    {{--</div>--}}
    {{--<div class="parameter-combination">--}}

    {{--</div>--}}
{{--</div>--}}