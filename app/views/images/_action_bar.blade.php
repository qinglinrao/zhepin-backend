<div class="action-bar">
    <div class="action-bar-left">
        {{ Form::button('创建相册', ['class'=>'btn btn-default']) }}
        {{ Form::button('删除', ['class'=>'btn btn-default']) }}
    </div>
    <div class="action-bar-right">{{ $images->links() }}</div>
</div>
