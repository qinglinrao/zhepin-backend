<?php

class Shop extends Eloquent{

    public function products(){
        return $this->hasMany('ShopProduct');
    }

    public function owner(){
        return $this->belongsTo('Merchant','merchant_id','id');
    }

}