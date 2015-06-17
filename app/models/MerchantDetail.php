<?php

class MerchantDetail extends Eloquent {


    public function merchant()
    {
        return $this->belongsTo('Merchant', 'merchant_id', 'id');
    }
}
