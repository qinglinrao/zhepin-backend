<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-1-19
 * Time: 下午4:11
 */

class ProductEntity extends Eloquent{

    public $timestamps = false;

    protected $fillable = ['sku', 'sale_price', 'stock', 'option_set', 'option_set_values', 'mapping_option_set', 'product_id'];

} 