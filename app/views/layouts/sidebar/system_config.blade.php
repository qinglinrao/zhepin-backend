@section('sidebar')
<div class="order-form-menu menu-item">
  <ul>
    <li>
      <a href="#" > 基本信息</a>
    </li>
    <li>
      <a href="#"> 角色设置</a>
    </li>
    <li>
      <a href="#"> 域名绑定</a>
    </li>
    <li>
      <a href="#" >扩展程序</a>
    </li>
    <li>
      <a href="#"> 物流信息</a>
    </li>
    <li>
      <a href="#"> 会员等级</a>
    </li>
    <li>
      <a href="#" > 积分规则</a>
    </li>
    <li>
      <a href="#"> SEO设置</a>
    </li>
    <li>
      <a href="{{URL::route('pay_setting')}}"> 支付配置</a>
    </li>
    <li>
      <a href="#"> 操作日志</a>
    </li>
  </ul>

</div>
@stop