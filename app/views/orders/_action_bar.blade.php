<div class="form-pagelist clearfix">
      <div class="pagelist-left">
        {{--<input type="checkbox" class="all-checkbox"/>--}}
        {{--<span class="all-choose">全选</span>--}}
        {{--<a href="#">发货</a>--}}
        <a href="{{URL::route('other.export_excel')}}">导出订单报表</a>
      </div>
      <div class="pagelist-right">
        {{--<a href="#">上一页</a><i>|</i><a href="#">下一页</a><i>第</i>--}}
        {{--<select>--}}
          {{--<option class="e-option" value ="1"><span>1</span>/<span>20</span></option>--}}
          {{--<option class="e-option" value="2"><span>2</span>/<span>20</span></option>--}}
          {{--<option class="e-option" value="3"><span>2</span>/<span>20</span></option>--}}
        {{--</select>--}}
{{--        {{print_r($orders->links())}}--}}
        @if($orders)
        {{$orders->appends($input)->links()}}
        @endif
      </div>
</div>