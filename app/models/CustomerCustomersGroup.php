<?php

class CustomerCustomersGroup extends Eloquent {

    public $timestamps = false;

    public function scopeCustomer($query,$customer_id){
        return $query->where('customer_id',$customer_id);
    }

    public function scopeGroup($query,$group_id){
        return $query->where('group_id',$group_id);
    }
}
