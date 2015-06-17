<?php

class Banner extends Eloquent {

    protected $table = 'banners';

    public function image(){
        return $this->belongsTo('Image');
    }

    public function scopeOfType($query,$type=1){
        return $query->where('type',$type);
    }
}