{{ Form::open(['route'=>'products.index', 'method'=>'GET']) }}
<div class="search-bar form-inline" ng-controller="SearchBarCtrl">
    <div class="search-top">
        {{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'请输入商品编辑或者商品名称进行搜索']) }}
        {{ Form::submit('查询', ['class'=>'btn btn-primary']) }}
        <a href="javascript:void(0)" class="more-filter" ng-click="isCollapsed = !isCollapsed">更多筛选条件</a>
    </div>
    <div collapse="isCollapsed" class="collapse">
        <table class="table">
            <tbody>
            <tr>
                {{--<th>--}}
                    {{--{{ Form::label('select.name', '活动') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                    {{--{{ Form::text('select.name', null, ['class'=>'form-control input-sm']) }}--}}
                {{--</td>--}}
                {{--<th>--}}
                    {{--{{ Form::label('select.name', '所在组') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                    {{--{{ Form::text('name', null, ['class'=>'form-control input-sm']) }}--}}
                {{--</td>--}}
                <th>
                    {{ Form::label('select.category', '所属分类') }}
                </th>
                <td>
                    {{ Form::select('root_category', [''=>'一级分类'], null, ['ng-model'=>'rootCategory', 'ng-options'=>'category.name for category in categories', 'ng-change'=>'updateSecondCategory(rootCategory)', 'class'=>'form-control input-sm']) }}
                    {{ Form::select('second_category', [''=>'二级分类'], null, ['ng-model'=>'secondCategory', 'ng-options'=>'secondCategory.name for secondCategory in secondCategories', 'ng-change'=>'chooseSecondCategory(secondCategory)', 'class'=>'form-control input-sm']) }}
                    {{ Form::hidden('category', $ng_category) }}
                </td>
                <th>
                    {{ Form::label('select.status', '商品状态') }}
                </th>
                <td>
                    {{ ProductHelper::status() }}
                </td>
                <th>
                    {{ Form::label('select.stock', '库存') }}
                </th>
                <td>
                    {{ Form::text('stock', null, ['class'=>'form-control input-sm']) }}
                </td>
            </tr>
            <tr>
                <th>
                    {{ Form::label('select.price', '价格区间') }}
                </th>
                <td>
                    {{ Form::text('price.from', null, ['class'=>'form-control input-sm']) }}
                    {{ Form::text('price.to', null, ['class'=>'form-control input-sm']) }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
{{ Form::close() }}