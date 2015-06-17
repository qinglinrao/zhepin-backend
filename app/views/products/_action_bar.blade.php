<div class="action-bar">
    <div class="action-bar-left">
        <label><input type="checkbox" class="all-checkbox" > 全选</label>
        <input type="hidden" id="son_checkbox_ids" value=""/>
        {{--<a class="btn btn-default" ng-click="openActivityModal()">参加活动</a>--}}
        {{--<a class="btn btn-default" ng-click="openFolderModal()">添加至...</a>--}}
        <button class="btn btn-default change_product_status" status="{{$status=='online'?'0':'1'}}">{{$status=='online'?'下架':'上架'}}</button>
    </div>
    <div class="action-bar-right">{{ $products->links() }}</div>
</div>