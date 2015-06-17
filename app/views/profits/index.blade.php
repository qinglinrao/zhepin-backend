@extends('layouts/interface')

@include('layouts.sidebar.profit')

@section('main')
<div class="vip-rank-wrap">
  <h3 class="o-title">分润配置</h3>
  <div class="vip-rank-table">
    <table>
      <thead>
        <tr>
          <th >配置名称</th>
          <th>第一级分润</th>
          <th>第二级分润</th>
          <th>第三级分润</th>
          <th>关联产品数</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach($profits as $profit)
        <tr>
          <td ><input type="hidden" class="id-input" value="{{$profit['id']}}"><input type="text" value="{{$profit['name']}}" class="txt-input name-input"/></td>
          <td><input type="" value="{{$profit['first']}}" class="first-input" >%</td>
          <td><input type="" value="{{$profit['two']}}" class="two-input">%</td>
           <td><input type="" value="{{$profit['three']}}" class="three-input">%</td>
          <td><b class="product_num">{{$profit->products->count()}}</b></td>
          <td><button class="button button-primary button-small " id="update-profit">更新</button>  <a href="{{URL::route('profit.del',array('id'=>$profit->id))}}" onclick="return confirm('该配置下关联的产品将被重置为不分润!')" class="button button-caution button-small ">删除</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <button class="button button-primary " id="to-add-profit">新增</button>

  </div>
  {{--<div class="message">--}}
    {{--<p>商城客户当达到一定条件之后可以成为会员 ，交易次数/交易额不统计交易关闭订单</p>--}}
  {{--</div>--}}
</div>
@stop
