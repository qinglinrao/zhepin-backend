<?php

class CustomerDetail extends Eloquent {

    public function image(){
        return $this->belongsTo('Image');
    }

}
