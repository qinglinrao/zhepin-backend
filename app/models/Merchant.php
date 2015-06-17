<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Merchant extends Eloquent  {

    public function image(){
        return $this->belongsTo('Image', 'image_id', 'id');
    }

    public function leader(){
        return $this->belongsTo('Merchant','leader_id');
    }

    public function follower(){
        return $this->hasMany('Merchant','leader_id');
    }

    public function shop(){
        return $this->hasOne('Shop','merchant_id','id');
    }

    public function customers(){
        return $this->hasMany('Customer','merchant_id','id');
    }

    public function account(){
        return $this->hasOne('MerchantAccount','merchant_id','id');
    }



}
