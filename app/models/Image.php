<?php

class Image extends Eloquent {

    protected $fillable = [
        'name', 'url', 'file_path', 'file_type', 'file_size', 'folder_id'
    ];
}