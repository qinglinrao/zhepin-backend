@extends('layouts/interface')

@include('layouts.sidebar.order')

@section('main')
    @include('orders._search_bar')
    @include('orders._action_bar')
    <div class="data-list">

        <div class="table-warp">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>商品信息</th>
                    <th>价格</th>
                    <th>所属分类</th>
                    <th>库存</th>
                    <th>销量</th>
                    <th>访问量</th>
                    <th>收藏</th>
                    <th>所在组</th>
                    <th>状态</th>
                    <th>参加活动</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <label for="all-choose" class="check"></label>
                        <input type="checkbox" id="all-choose" class="checkbox"/>
                    </td>
                    <td class="media">
                        <a class="media-left" href="#">
                            <img src="images/product.jpg"/>
                        </a>
                        <div class="media-body">
                            <a href="#">达芙妮新款顺丰包邮达芙妮新款顺丰包邮</a><br/>
                            <i>编号：<span>233233233233</span></i>
                        </div>
                    </td>
                    <td>
                        <span class="price price-sale">￥129.00</span><br/>
                        <del class="price price-par">￥129.00</del>
                    </td>
                    <td>女-高跟鞋子</td>
                    <td>299</td>
                    <td>99</td>
                    <td>
                        PV：21254<br/>
                        UV：2254
                    </td>
                    <td>110</td>
                    <td>文件夹2</td>
                    <td>
                        <span class="status status-online">已上架</span>
                    </td>
                    <td>
                        <span class="activity activity-rebate">折</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                    </td>
                    <td class="operation">
                        <a href="#">编辑</a>
                        <a href="#">复制</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="all-choose" class="check"></label>
                        <input type="checkbox" id="all-choose" class="checkbox"/>
                    </td>
                    <td class="media">
                        <a class="media-left" href="#">
                            <img src="images/product.jpg"/>
                        </a>
                        <div class="media-body">
                            <a href="#">达芙妮新款顺丰包邮达芙妮新款顺丰包邮</a><br/>
                            <i>编号：<span>233233233233</span></i>
                        </div>
                    </td>
                    <td>
                        <span class="price price-sale">￥129.00</span><br/>
                        <del class="price price-par">￥129.00</del>
                    </td>
                    <td>女-高跟鞋子</td>
                    <td>299</td>
                    <td>99</td>
                    <td>
                        PV：21254<br/>
                        UV：2254
                    </td>
                    <td>110</td>
                    <td>文件夹2</td>
                    <td>
                        <span class="status status-online">已上架</span>
                    </td>
                    <td>
                        <span class="activity activity-rebate">折</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                    </td>
                    <td class="operation">
                        <a href="#">编辑</a>
                        <a href="#">复制</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="all-choose" class="check"></label>
                        <input type="checkbox" id="all-choose" class="checkbox"/>
                    </td>
                    <td class="media">
                        <a class="media-left" href="#">
                            <img src="images/product.jpg"/>
                        </a>
                        <div class="media-body">
                            <a href="#">达芙妮新款顺丰包邮达芙妮新款顺丰包邮</a><br/>
                            <i>编号：<span>233233233233</span></i>
                        </div>
                    </td>
                    <td>
                        <span class="price price-sale">￥129.00</span><br/>
                        <del class="price price-par">￥129.00</del>
                    </td>
                    <td>女-高跟鞋子</td>
                    <td>299</td>
                    <td>99</td>
                    <td>
                        PV：21254<br/>
                        UV：2254
                    </td>
                    <td>110</td>
                    <td>文件夹2</td>
                    <td>
                        <span class="status status-online">已上架</span>
                    </td>
                    <td>
                        <span class="activity activity-rebate">折</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                    </td>
                    <td class="operation">
                        <a href="#">编辑</a>
                        <a href="#">复制</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="all-choose" class="check"></label>
                        <input type="checkbox" id="all-choose" class="checkbox"/>
                    </td>
                    <td class="media">
                        <a class="media-left" href="#">
                            <img src="images/product.jpg"/>
                        </a>
                        <div class="media-body">
                            <a href="#">达芙妮新款顺丰包邮达芙妮新款顺丰包邮</a><br/>
                            <i>编号：<span>233233233233</span></i>
                        </div>
                    </td>
                    <td>
                        <span class="price price-sale">￥129.00</span><br/>
                        <del class="price price-par">￥129.00</del>
                    </td>
                    <td>女-高跟鞋子</td>
                    <td>299</td>
                    <td>99</td>
                    <td>
                        PV：21254<br/>
                        UV：2254
                    </td>
                    <td>110</td>
                    <td>文件夹2</td>
                    <td>
                        <span class="status status-online">已上架</span>
                    </td>
                    <td>
                        <span class="activity activity-rebate">折</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                        <span class="activity activity-grab">抢</span>
                    </td>
                    <td class="operation">
                        <a href="#">编辑</a>
                        <a href="#">复制</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('orders._action_bar')
@stop