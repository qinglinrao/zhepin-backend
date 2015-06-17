<?php

class CustomerOrder extends Eloquent {

    public function orderProducts(){
        return $this->hasMany('CustomerOrderProduct','order_id','id');
    }

    public function orderAddress(){
        return $this->hasOne('CustomerOrderAddress','order_id','id');
    }

    public  function customer(){
        return $this->belongsTo('Customer','customer_id','id');
    }

    public function histories(){
        return $this->hasMany('CustomerOrderHistory','order_id','id');
    }

    public function logistics(){
        return $this->belongsTo('LogisticsCompany','logistics_company_id','id');
    }


}
