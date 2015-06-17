<?php

class CustomerOrderProduct extends Eloquent {

    protected $table = 'customer_order_products';

    public function product(){
        return $this->belongsTo('Product','product_id','id');
    }

    public function productEntity(){
        return $this->belongsTo('ProductEntity','product_entity_id','id');
    }

    public function shop(){
        return $this->belongsTo('Shop','shop_id','id');
    }

}
