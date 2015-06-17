<div class="action-bar">
    <div class="action-bar-left">
        {{ HTML::linkRoute('attribute-sets.create', '添加属性', null, ['class'=>'btn btn-default']) }}
    </div>
    <div class="action-bar-right">
        {{ $attributes->links() }}
    </div>
</div>