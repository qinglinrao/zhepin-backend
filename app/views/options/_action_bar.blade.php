<div class="action-bar">
    <div class="action-bar-left">
        {{ HTML::linkRoute('options.create', '添加规格', null, ['class'=>'btn btn-primary']) }}
    </div>
    <div class="action-bar-right">
        {{ $options->links() }}
    </div>
</div>
