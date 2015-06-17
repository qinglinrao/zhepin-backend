<?php

class ProductOptionsProduct extends Eloquent {

	protected static $matchSite = false;
	
    public $timestamps = false;

    protected $fillable = ['product_id', 'option_id', 'option_value_id'];

    public function image()
    {
        return $this->belongsTo('Image', 'image_id', 'id');
    }

}
