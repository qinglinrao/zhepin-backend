<div class="action-bar">
    <div class="action-bar-left">
        {{--<label for="all-choose" class="check "></label>--}}
        {{--<input type="checkbox" class="all-checkbox"/>--}}
        {{--<input type="hidden" id="son_checkbox_ids" value=""/>--}}
        {{--<span class="all-choose">全选</span>--}}
        {{--<button class="button  button-caution button-small button-plain button-uppercase button-rounded" id="batch_del_customer" url="{{URL::route('customers.batch_delete')}}">删除</button>--}}
    </div>
    <div class="pagelist-right">
            {{$account_logs->appends($input)->links()}}
    </div>
</div>
