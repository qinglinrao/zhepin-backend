<?php

class CategoryAttributeSet extends Eloquent {

	public static $rules = [
		// 'title' => 'required'
	];

	protected $fillable = ['name', 'note'];
}
