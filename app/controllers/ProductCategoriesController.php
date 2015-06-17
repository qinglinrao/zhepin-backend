<?php

class ProductCategoriesController extends \BaseController {

	public function __construct(ProductCategory $product_category)
	{
		$this->entity = $product_category;
	}

	public function index()
	{
		$query = trim(Input::get('query'));

		if($query)
			$category_roots = $this->entity->where('name', 'like', '%'.$query.'%');
		else
			$category_roots = $this->entity->roots();

		$category_roots = $category_roots->with('children','image')->get();

		return View::make('categories.index', compact('category_roots', 'query'));
	}

	public function create()
	{
		$category = $this->entity;

		return View::make('categories.create', compact('category'));
	}

	public function store()
	{
		$this->entity->fill(Input::all());
        $this->entity->parent_id = Input::get('parent_id') ? Input::get('parent_id') : null;
		$this->entity->save();

		return Redirect::route('categories.index');
	}

	public function edit($id)
	{
		$category = $this->entity->findOrFail($id);

		return View::make('categories.edit', compact('category'));
	}

	public function update($id)
	{
        $entity = $this->entity->findOrFail($id);

        $entity->fill(Input::all());
        $entity->parent_id = Input::get('parent_id') ? Input::get('parent_id') : null;
        $entity->save();

        return Redirect::route('categories.index');
	}

	public function destroy($id)
	{
		$this->entity->destroy($id);

		return $this->entity;
	}
}
