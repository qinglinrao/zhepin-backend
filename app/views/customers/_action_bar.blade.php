<div class="action-bar">
    <div class="action-bar-left">
        {{--<label for="all-choose" class="check "></label>--}}
        {{--<input type="checkbox" class="all-checkbox"/>--}}
        {{--<span class="all-choose">全选</span>--}}
        {{--<button class="button  button-primary button-rounded button-small">发送短信</button>--}}
        {{--<button class="button  button-primary button-rounded button-small">发送邮件</button>--}}
        {{--<select class="add_to_group_select" url="{{action('AjaxController@postAddToGroup')}}">--}}
            {{--<option class="e-option" value ="">----添加到组---</option>--}}
            {{--@foreach($customer_groups as $group)--}}
            {{--<option class="e-option" value ="{{$group['id']}}">添加到组[{{$group['name']}}]</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
{{--        {{Form::select('add_group',array_merge(array(0=>'----添加到组---'),get_customer_groups()),'',array('class'=>'add_to_group_select ','url'=>action('AjaxController@postAddToGroup')))}}--}}
    </div>
    <div class="pagelist-right">
            {{--<a href="#">上一页</a><i>|</i><a href="#">下一页</a><i>第</i>--}}
            {{--<select>--}}
              {{--<option class="e-option" value ="1"><span>1</span>/<span>20</span></option>--}}
              {{--<option class="e-option" value="2"><span>2</span>/<span>20</span></option>--}}
              {{--<option class="e-option" value="3"><span>2</span>/<span>20</span></option>--}}
            {{--</select>--}}
    {{--        {{print_r($orders->links())}}--}}
            {{$customers->appends($input)->links()}}
    </div>
    {{--<div class="action-bar-right" ng-include="'partials/pagination.html'"></div>--}}
</div>
