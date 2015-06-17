<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Entity extends Eloquent
{
    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = [];

    protected static $matchSite = true;

    public static function boot()
    {
        parent::boot();

        if(static::$matchSite && Auth::user())
        {
            static::saving(function($entity)
            {
                $entity->site_id = SITE_ID;
            });
        }
    }

    public function scopeDomain($query){

        return $query->where('site_id',SITE_ID);
    }

    public function scopeLatest($query){
        return $query->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc');
    }
}
