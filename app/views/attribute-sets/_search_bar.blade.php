{{ Form::open(['route'=>'products.index', 'method'=>'GET']) }}
<div class="search-bar form-inline">
    <div class="search-top">
        {{ Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'请输入分类名称进行搜索']) }}
        {{ Form::submit('查询', ['class'=>'btn btn-primary']) }}
    </div>
</div>
{{ Form::close() }}