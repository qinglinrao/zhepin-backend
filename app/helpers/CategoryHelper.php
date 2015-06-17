<?php
class CategoryHelper
{
    public static function roots($selected=null, $category=null)
    {
//        $category_roots = ProductCategory::roots();
//        if($category && $category->isRoot()) $category_roots = $category_roots->whereNotIn('id', [$category->id]);
//        $category_roots = $category_roots->lists('name', 'id');
//        $category_roots = [0=>'顶级分类'] + $category_roots;
//
//        return Form::select('status', $category_roots, $selected, ['class'=>'form-control']);
        $category_roots = ProductCategory::roots();
        if($category && $category->isRoot()) $category_roots = $category_roots->whereNotIn('id', [$category->id]);
        $category_roots = $category_roots->lists('name', 'id');
        $category_roots = [0=>'顶级分类'] + $category_roots;

        return Form::select('parent_id', $category_roots, $selected, ['class'=>'form-control']);
    }
}