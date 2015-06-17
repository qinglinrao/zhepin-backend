<?php

/*
|------------------
| 注册模型观察者实例
|------------------
*/
Product::observe(new ProductObserver);
ProductOption::observe(new ProductOptionObserver);
Merchant::observe(new MerchantObserver());