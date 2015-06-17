<?php

class ProductOption extends Eloquent {

    protected $fillable = ['name'];
    public static $rules = [
        'name' => 'required'
    ];

    public function values()
    {
        return $this->hasMany('ProductDefaultOptionValue', 'option_id', 'id');
    }
}
