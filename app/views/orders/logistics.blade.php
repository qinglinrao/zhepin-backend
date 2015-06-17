@extends('layouts/interface')

@include('layouts.sidebar.order')

@section('main')
<div class="order-logistics">
  <h3 class="o-title">物流设置</h3>
  <div class="new-stencil">
    <a href="#">新建运费模版</a>
  </div>
  <div class="stencil-table">
    <div class="stencil-top">
      <i>江浙沪包邮</i><span><b>最后编辑时间:2014-11-13 15:21</b><a href="#">复制模板</a><a href="#">修改</a><a href="#">删除</a></span>
    </div>
    <div class="stencil-bottom">
      <table>
	<tbody>
	  <tr>
	    <th class="first">配送范围</th>
	    <th>首件（个）</th>
	    <th>运费（元）</th>
	    <th>续件（个）</th>
	    <th>运费（元）</th>
	  </tr>
	  <tr>
	    <td class="one">江苏、浙江、上海</td>
	    <td>1</td>
	    <td>12.00</td>
	    <td>1</td>
	    <td>12.00</td>
	  </tr>
	</tbody>
      </table>

    </div>
  </div>

</div>
@stop