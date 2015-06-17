<?php

class ProductProfit extends Eloquent {


    public function products(){
        return $this->hasMany('Product','profit_id','id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($entity)
        {
            $products = $entity->products();
            foreach($products as $product){
                $product->update(array('profit_id'=>0));
            }
        });
    }
}
