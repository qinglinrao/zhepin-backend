<?php

class ProductCategory extends Baum\Node {

    protected $fillable = ['name', 'parent_id', 'sort_order'];

    public static function boot()
    {
        parent::boot();

//        static::saving(function($entity)
//        {
//            if($entity->parent_id != 0) $entity->parent_id;
//        });
    }

    public function parentCategory(){
        return $this->belongsTo('ProductCategory','parent_id','id');
    }

    public function image(){
        return $this->belongsTo('Image','image_id','id');
    }

//    public function scopeRoots($query){
//        return $query->where('parent_id',0);
//    }


}
