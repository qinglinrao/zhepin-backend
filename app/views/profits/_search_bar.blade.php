{{ Form::open(['url'=>URL::route('profit.merchants',array('type'=>$type)), 'method'=>'GET']) }}
<div class="search-bar form-inline" ng-controller="SearchBarCtrl">

    <div class="search-top">
        {{ Form::text('query', $query, ['id'=>'query','class'=>'form-control', 'placeholder'=>'请输入姓名或关键词进行搜索']) }}
        {{ Form::submit('查询', ['class'=>'btn btn-primary']) }}
        {{--<a href="javascript:void(0)" class="more-filter" ng-click="isCollapsed = !isCollapsed">更多筛选条件</a>--}}
    </div>
    {{--<div collapse="isCollapsed" class="collapse">--}}
        {{--<table class="table">--}}
            {{--<tbody>--}}
            {{--<tr>--}}
                {{--<th>--}}
                    {{--{{ Form::label('email', '活动') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                    {{--{{ Form::text('email', $email, ['class'=>'form-control input-sm']) }}--}}
                {{--</td>--}}
                {{--<th>--}}
                    {{--{{ Form::label('telephone', '手机号') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                    {{--{{ Form::text('telephone', $telephone, ['class'=>'form-control input-sm']) }}--}}
                {{--</td>--}}
                {{--<th>--}}
                    {{--{{ Form::label('register_time', '注册时间') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                     {{--{{ Form::text('register_time[from]', $register_time['from'], ['class'=>'form-control input-sm form_date', 'data-date-format'=>'yyyy-mm-dd']) }}--}}
                     {{--{{ Form::text('register_time[to]', $register_time['to'], ['class'=>'form-control input-sm form_date', 'data-date-format'=>'yyyy-mm-dd']) }}--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th>--}}
                    {{--{{ Form::label('group', '所在组') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                    {{--{{ Form::select('group', array_merge(array(0=>'--所有--'), get_customer_groups()), $group, ['class'=>'form-control input-sm']) }}--}}
                {{--</td>--}}
                {{--<th>--}}
                    {{--{{ Form::label('group', '状态') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                    {{--<select class="form-control input-sm">--}}
                        {{--<option class="e-option" value ="1">支付</option>--}}
                        {{--<option class="e-option" value="2">未支付</option>--}}
                    {{--</select>--}}
                {{--</td>--}}
                {{--<th>--}}
                    {{--{{ Form::label('last_login_time', '最后一次登陆时间') }}--}}
                {{--</th>--}}
                {{--<td>--}}
                    {{--{{Form::text('last_login_time[from]', $last_login_time['from'], ['class'=>'form-control input-sm form_date', 'data-date-format'=>'yyyy-mm-dd'])}}--}}
                    {{--{{Form::text('last_login_time[to]', $last_login_time['to'], ['class'=>'form-control input-sm form_date', 'data-date-format'=>'yyyy-mm-dd'])}}--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}
</div>
{{ Form::close() }}