@extends('layouts/interface')

@include('layouts.sidebar.order')

@section('main')
<div class="order-set">
  <div class="order-set-wrap">
    <ul class="set-list">
      <li>
	<div class="set-row">
	  <div class="set-left"><span>拍下未付款：</span></div>
	  <div class="set-right"><input type="text" class="set-time" value="30" /><span>分钟内未付款，自动取消订单；</span></div>
	</div>
	<div class="set-row">
	  <div class="set-left"><span>催付通知：</span></div>
	  <div class="set-right"><input type="text"  class="set-time"  value="10" /><span>分钟内未付款，自动向买家发送订单催付订单；</span></div>
	</div>
      </li>
      <li>
	<div class="set-row">
	  <div class="set-left"><span>支付成功通知：</span></div>

	  <div class="set-right">
	    <label for="check-sms" class="check current"></label>
	    <input type="checkbox" id="check-sms" class="checkbox"/><span>短信提醒</span>
	    <select>
	      <option class="e-option" value ="1">默认通知模板</option>
	      <option class="e-option" value="2">默认通知模板</option>
	    </select>
	  </div>
	</div>
	<div class="set-row">
	  <div class="set-left"></div>
	  <div class="set-right">
	    <label for="check-email" class="check"></label>
	    <input type="checkbox" id="check-email" class="checkbox"/><span>邮件提醒</span>
	    <select>
	      <option class="e-option" value ="1">默认通知模板</option>
	      <option class="e-option" value="2">默认通知模板</option>
	    </select>
	  </div>
	</div>
      </li>

      <li>
	<div class="set-row">
	  <div class="set-left"><span>发货通知：</span></div>

	  <div class="set-right">
	    <label for="check-sms" class="check current"></label>
	    <input type="checkbox" id="check-sms" class="checkbox"/><span>短信提醒</span>
	    <select>
	      <option class="e-option" value ="1">默认通知模板</option>
	      <option class="e-option" value="2">默认通知模板</option>
	    </select>
	  </div>
	</div>
	<div class="set-row">
	  <div class="set-left"></div>
	  <div class="set-right">
	    <label for="check-email" class="check"></label>
	    <input type="checkbox" id="check-email" class="checkbox"/><span>邮件提醒</span>
	    <select>
	      <option class="e-option" value ="1">默认通知模板</option>
	      <option class="e-option" value="2">默认通知模板</option>
	    </select>
	  </div>
	</div>
      </li>

      <li>
	<div class="set-row">
	  <div class="set-left"><span>售后／退款通知：</span></div>

	  <div class="set-right">
	    <label for="check-sms" class="check current"></label>
	    <input type="checkbox" id="check-sms" class="checkbox"/><span>短信提醒</span>
	    <select>
	      <option class="e-option" value ="1">默认通知模板</option>
	      <option class="e-option" value="2">默认通知模板</option>
	    </select>
	  </div>
	</div>
	<div class="set-row">
	  <div class="set-left"></div>
	  <div class="set-right">
	    <label for="check-email" class="check"></label>
	    <input type="checkbox" id="check-email" class="checkbox"/><span>邮件提醒</span>
	    <select>
	      <option class="e-option" value ="1">默认通知模板</option>
	      <option class="e-option" value="2">默认通知模板</option>
	    </select>
	  </div>
	</div>
      </li>
    </ul>

  </div>
</div>
@stop