<?php

class MerchantAccountLog extends Eloquent{

  protected $table = 'merchant_account_logs';

  public function merchant(){
      return $this->belongsTo('Merchant','merchant_id','id');
  }

  public function upCoverImage(){
      return $this->belongsTo('Image','identity_up_image_id','id');
  }

  public function downCoverImage(){
      return $this->belongsTo('Image','identity_down_image_id','id');
  }






}