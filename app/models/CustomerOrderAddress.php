<?php

class CustomerOrderAddress extends Eloquent {

    public $timestamps = false;

    public function region(){
        return $this->belongsTo('Region','region_id');
    }

}
