@extends('layouts/interface')

@include('layouts.sidebar.catalog')

@section('style')
<link rel="stylesheet" href="/stylesheets/imageZoom.css"/>
@stop

@section('main')
    @include('layouts.messages')
    {{ Form::model($product, ['method'=>'PATCH', 'route'=>['products.update', $product->id], 'ng-controller'=>'ProductCtrl']) }}
    <fieldset>
        <legend>基本信息</legend>
        <table class="table edit-table">
            <tbody>
            <tr>
                <th>商品类目：</th>
                <td>
                    {{ Form::select('rootCategory', get_root_categories(), get_root_category_id($product->category_id), [ 'class'=>'form-control input-sm','id'=>'rootCategorySelect']) }}
                    {{ Form::select('secondCategory', get_second_categories($product->category_id), get_root_category_id($product->category_id,false), [ 'class'=>'form-control input-sm','id'=>'secondCategorySelect']) }}
                    {{--<p class="form-control-static">{{ $product->category->name }}</p>--}}
                    {{ Form::hidden('category_id',$product->category_id,['id'=>'category_id']) }}
                </td>
            </tr>
            <!-- <tr>
                <th>商品类型：</th>
                <td>
                    <label fot="real-product" class="radio-style radio-choose" ></label>
                    <input type="radio" class="range-radio" id="real-product" name="product-type" checked="checked"/>
                    <span class="td-middle">实物商品<span class="declare">（物流发货）</span></span>

                    <label fot="virtual-product" class="radio-style" ></label>
                    <input type="radio" class="range-radio" id="virtual-product" name="product-type" />
                    <span class="td-middle">虚拟商品<span class="declare">（无需物流）</span></span>
                </td>
            </tr> -->
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend>商品信息</legend>
        <table class="table edit-table">
            <tbody>
            <tr>
                <th>商品标题：</th>
                <td>{{ Form::text('name', null, ['class'=>'form-control']) }}</td>
            </tr>
            <tr>
                <th>副标题：</th>
                <td>{{ Form::text('title', null, ['class'=>'form-control']) }}</td>
            </tr>
            <tr>
                <th>价格：</th>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon">¥</div>
                        {{ Form::text('sale_price', null, ['class'=>'form-control', 'placeholder'=>'0.00']) }}
                    </div>
                </td>
            </tr>
            <tr>
                <th>分润：</th>
                <td>
                    <div class="input-group">
                        <div class="input-group-addon">¥</div>
                        {{ Form::text('profit', null, ['class'=>'form-control', 'placeholder'=>'0.00']) }}
                        {{--{{ Form::hidden('ba_profit', 50) }}--}}
                        {{--{{ Form::hidden('store_profit', 30) }}--}}
                        {{--{{ Form::hidden('agent_profit', 20) }}--}}
                    </div>
                </td>
            </tr>
            <tr>
                <th>商品推荐：</th>
                <td>
                    <div class="input-group">
                        <div class="choose_product_type">
                            <label>使用部位:</label>&nbsp;&nbsp;
                            {{Form::radio('use_position', '1', $product->use_position==1?true:false)}}脸部 &nbsp;&nbsp;
                            {{Form::radio('use_position', '2', $product->use_position==2?true:false)}}手部 &nbsp;&nbsp;
                            {{Form::radio('use_position', '3', $product->use_position==3?true:false)}}眼窝
                        </div>
                        <div class="choose_product_type">
                             <label>肌肤状态:</label>&nbsp;&nbsp;
                            {{Form::radio('skin_status', '1', $product->skin_status==1?true:false)}}干燥 &nbsp;&nbsp;
                            {{Form::radio('skin_status', '2', $product->skin_status==2?true:false)}}正常 &nbsp;&nbsp;
                            {{Form::radio('skin_status', '3', $product->skin_status==3?true:false)}}湿润
                        </div>

                    </div>
                </td>
            </tr>
            <tr>
                <th>定制产品？：</th>
                <td>
                    <div class="input-group">
                        <div class="choose_product_type">
                            {{Form::radio('display_type', '1', $product->display_type==1?true:false)}}是&nbsp;&nbsp;
                            {{Form::radio('display_type', '0', $product->display_type==0?true:false)}}否
                        </div>

                    </div>
                </td>
            </tr>
            <tr>
                <th>分润配置：</th>
                <td>
                    <div class="input-group">

                         <div class="profit_rules" style="display:{{$product->display_type==1?'none':'block'}}">
                            @foreach(ProductProfit::all() as $profit)
                                 <span profit_id="{{$profit->id}}" first="{{$profit->first}}" two="{{$profit->two}}" three="{{$profit->three}}" class="{{$product->profit_id == $profit->id?'cur':''}}" title="{{$profit->name."(第一级:$profit->first%  第二级:$profit->two%  第三级:$profit->three%)"}}">{{$profit->name."($profit->first%,$profit->two%,$profit->three%)"}}</span>
                            @endforeach
                            {{ Form::hidden('profit_id',0,['class'=>'profit_id']) }}
                         </div>
                          <table class="profit_val">
                            <tr style="display: block">
                                <td width="55px" class="first_element">{{$product->display_type==1?'美肤专家':'第一级'}}</td>
                                <td>{{ Form::text('first_profit', $product->first_profit, ['class'=>'form-control first_profit', 'placeholder'=>'请输入第一级分润的百分比,默认为0']) }}<b>%</b></td>
                            </tr>
                            <tr style="display:{{$product->display_type==1?'none':'block'}}">
                                <td width="55px">第二级</td>
                                <td>{{ Form::text('two_profit', $product->two_profit, ['class'=>'form-control two_profit', 'placeholder'=>'请输入第二级分润的百分比,默认为0']) }}<b>%</b></td>
                            </tr>
                            <tr style="display: {{$product->display_type==1?'none':'block'}}">
                                <td width="55px">第三级</td>
                                <td>{{ Form::text('three_profit', $product->three_profit, ['class'=>'form-control three_profit', 'placeholder'=>'请输入第三级分润的百分比,默认为0']) }}<b>%</b></td>
                            </tr>
                          </table>
{{--                        {{Form::select('profit_id',get_profit_templates(), $product->profit_id)}}--}}
                    </div>
                </td>
            </tr>
            <tr>
                <th>商品图片：</th>
                <td>
                    <div id="photo-warp">
                        @foreach($product->images as $image)
                        <div class="item">
                            <a class="corner" href="#">
                                &times;
                            </a>
                            {{ Form::hidden('images[]', $image->id) }}
                            {{ ProductHelper::render_image($image) }}
                        </div>
                        @endforeach
                    </div>
                    <span class="fileinput-button">
                        <span>上传图片</span>
                        <input id="multiple-photo-upload" type="file" name="photo" multiple>
                    </span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>建议尺寸：640 x 640 像素<!-- ；您可以拖拽图片调整图片顺序。 --></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend>规格／库存</legend>
        <table class="table edit-table">
            <tbody>
            <tr>
                <th>商品规格:</th>
                <td>
                    @include('products._parameter')
                </td>
            </tr>
            <tr>
                <th>总库存:</th>
                <td>{{ Form::text('stock', null, ['class'=>'form-control']) }}</td>
            </tr>
            <tr>
                <th>商品编码:</th>
                <td>{{ Form::text('sku', null, ['class'=>'form-control']) }}</td>
            </tr>
            <tr>
                <th>商品详情:</th>
                <td>{{ Form::textarea('detail', null, ['class'=>'editor']) }}</td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend>其他</legend>
        <table class="table edit-table">
            <tbody>
            {{--<tr>--}}
                {{--<th>服务标签:</td>--}}
                {{--<td>--}}
                    {{--{{ ProductHelper::services() }}--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>物流信息:</td>--}}
                {{--<td>{{ Form::select('name', [], null, ['class'=>'form-control']) }}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>发票:</th>--}}
                {{--<td>--}}
                    {{--{{ ProductHelper::invoice() }}--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>库存计数:</th>--}}
                {{--<td>--}}
                    {{--{{ ProductHelper::counting_method() }}--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>开始时间:</th>--}}
                {{--<td>--}}
                    {{--<div class="radio">--}}
                        {{--<label>--}}
                            {{--{{ Form::radio('visible', 1) }}--}}
                            {{--立刻--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="radio">--}}
                        {{--<label>--}}
                            {{--{{ Form::radio('visible', 2) }}--}}
                            {{--设定时间--}}
                        {{--</label>--}}
                        {{--{{ Form::text('published_at', null, ['class'=>'datetimepicker']) }}--}}
                    {{--</div>--}}
                    {{--<div class="radio">--}}
                        {{--<label>--}}
                            {{--{{ Form::radio('visible', 0) }}--}}
                            {{--放入仓库--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</td>--}}
            {{--</tr>--}}
            <tr>
                <th>上下架？:</th>
                <td>
                    <div class="radio">
                        <label>
                            {{ Form::radio('visible', 1) }}
                            上架
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            {{ Form::radio('visible', 0) }}
                            下架
                        </label>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <div class="form-action">
        <button class="btn btn-default">取消</button>
        <button class="btn btn-primary">保存</button>
        {{--<button class="btn btn-success">发布</button>--}}
    </div>
    {{ Form::close() }}
@stop