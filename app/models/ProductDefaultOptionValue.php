<?php

class ProductDefaultOptionValue extends Eloquent {

    protected $fillable = ['name'];

    public function image()
    {
        return $this->belongsTo('Image', 'image_id', 'id');
    }

}
