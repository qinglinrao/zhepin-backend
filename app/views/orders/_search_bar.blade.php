{{Form::open(array('url'=>URL::route('orders.index'),'method'=>'get'))}}
   <input type="hidden" id="son_checkbox_ids" value=""/>
   <div class="search">
     <div class="search-top">
        {{Form::text('query',$query,array('class'=>'name','placeholder'=>'请输入订单编号或者商品名称'))}}
        <input type="submit" class="submit" value="查询" />
        <span class="more-filter">收起筛选条件</span>
     </div>
     <div class="search-bottom">
         <div class="filter-list">
            <ul class="clearfix">
              <li>
                <span>收货人</span>
                {{Form::text('address_name',$query)}}
              </li>
              <li>
                 <span>手机号</span>
                 {{Form::text('telephone',$telephone)}}
              </li>

              <li>
                 <span>下单时间</span>
                 {{Form::text('buy_time[from]',$buy_time['from'],array('class'=>'form_date','data-date-format'=>'yyyy-mm-dd'))}}
                 {{Form::text('buy_time[to]',$buy_time['to'],array('class'=>'form_date','data-date-format'=>'yyyy-mm-dd'))}}
              </li>

              <li>
                <span>订单状态</span>
                {{Form::select('status',array_merge(array('0'=>'所有'),get_order_status()),$status)}}
              </li>
              <li>
                <span>收货地址</span>
                {{Form::select('region[province]',get_all_provinces(),$region['province'],array('id'=>'province_select'))}}
                {{Form::select('region[city]',array('0'=>'--请选择市--'),$region['city'],array('id'=>'city_select'))}}
              </li>
               <li>
                    <span>库存</span>
                    {{Form::select('stock',array_merge(array('0'=>'--所有--'),get_stock_status()),$stock)}}
                </li>
            </ul>
         </div>
     </div>
   </div>
 {{Form::close()}}