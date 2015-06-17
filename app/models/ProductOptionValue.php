<?php

class ProductOptionValue extends Eloquent {

    protected $fillable = ['option_id', 'name', 'mapping_value_id'];

    public function image()
    {
        return $this->belongsTo('Image', 'image_id', 'id');
    }

}
