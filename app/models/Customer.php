<?php

class Customer extends Eloquent {

    public function level(){
        return $this->belongsTo('CustomerLevel','level_id');
    }

    public function groups(){
        return $this->belongsToMany('CustomerGroup','customer_customers_groups','customer_id','group_id');
    }

    public function customerGroup(){
        return $this->hasMany('CustomerCustomersGroup','customer_id','id');
    }


    public function detail(){
        return $this->hasOne('CustomerDetail');
    }

    public function merchant(){
        return $this->belongsTo('Merchant');
    }

    public function orders(){
        return $this->hasMany('CustomerOrder','customer_id','id');
    }



}
