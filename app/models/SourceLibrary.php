<?php

class SourceLibrary extends Entity {
    protected $table = 'source_libraries';

    protected $fillable = [
        'title','author','image_id','summary','content','source_type'
    ];

    public function image(){
        return $this->belongsTo('Image','image_id','id');
    }
}
