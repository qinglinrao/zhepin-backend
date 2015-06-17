<?php

class Product extends Eloquent {

    protected $fillable = [
        'name', 'detail', 'note', 'sku', 'par_price', 'sale_price', 'image_id', 'category_id',
        'brand_id', 'enabled', 'visible', 'published_at', 'sort_order', 'stock', 'invoice', 'counting_method',
        'profit_id','first_profit','two_profit','three_profit','display_type','title','use_position','skin_status','profit'
    ];

    public static $rules = [
         'name' => 'required',
         'category_id' => 'required',
         'detail' => 'required',
         'sku' => 'required',
         'sale_price' => 'required',
         'stock' => 'required',
         'first_profit' => 'required|integer|between:0,80',
         'two_profit' => 'required|integer|between:0,80',
         'three_profit' => 'required|integer|between:0,80'
    ];

    public function entities()
    {
        return $this->hasMany('ProductEntity', 'product_id', 'id');
    }

    public function options()
    {
        return $this->belongsToMany('ProductOptionValue', 'product_options_products', 'product_id', 'option_value_id');
    }

    public function services()
    {
        return $this->belongsToMany('ProductService', 'products_product_services', 'product_id', 'service_id');
    }

    public function images()
    {
        return $this->belongsToMany('Image', 'product_images_products', 'product_id', 'image_id');
    }

    public function category()
    {
        return $this->belongsTo('ProductCategory', 'category_id', 'id');
    }


    public function thumb()
    {
        return $this->belongsTo('Image', 'image_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
//        if($folder = $search['folder']) {
//            $query = $query->join('product_folders_products', 'product_folders_products.product_id', '=', 'products.id')
//                ->whereFolderId($folder);
//        }

        if($category = $search['category']) {
            $query = $query->whereCategoryId($category);
        }

        $price = $search['price'];
        $query = $query->where(function($query) use ($price)
        {
            if($price['from'])
                $query = $query->where('sale_price', '>=', $price['from']);

            if($price['to'])
                $query->where('sale_price', '<=', $price['to']);
        });

        if($search['name']){
            $query->where('name','like','%'.$search['name'].'%');
        }

        return $query;
    }

    public function scopeStatus($query, $status)
    {
        $visible = [
            'online' => 1,
            'offline' => 0
        ];

        return $query->whereVisible($visible[$status]);
    }

    public function scopeVisible($query){
        return $query->where('visible',1);
    }

    public function  scopeOfType($query,$type=1){
        return $this->where('display_type',$type);
    }
}
