<?php

class AttributeSetsController extends \BaseController {

	# GET /attribute-sets
	public function index()
	{
		$attribute_sets = CategoryAttributeSet::paginate();

		return View::make('attribute-sets.index', compact('attribute_sets'));
	}

	# GET /attribute-sets/create
	public function create()
	{
		return View::make('attribute-sets.create');
	}

	# POST /attribute-sets
	public function store()
	{
		$validator = Validator::make($data = Input::all(), CategoryAttributeSet::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		CategoryAttributeSet::create($data);

		return Redirect::route('attribute-sets.index');
	}

	# GET /attribute-sets/{id}
	public function show($id)
	{
		$attribute_set = CategoryAttributeSet::findOrFail($id);

		return View::make('attribute-sets.show', compact('attribute_set'));
	}

	# GET /attribute-sets/{id}/edit
	public function edit($id)
	{
		$attribute_set = CategoryAttributeSet::find($id);

		return View::make('attribute-sets.edit', compact('attribute_set'));
	}

	# PUT /attribute-sets/{id}
	public function update($id)
	{
		$attribute_set = CategoryAttributeSet::findOrFail($id);

		$validator = Validator::make($data = Input::all(), CategoryAttributeSet::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$attribute_set->update($data);

		return Redirect::route('attribute-sets.index');
	}

	# DELETE /attribute-sets/{id}
	public function destroy($id)
	{
		CategoryAttributeSet::destroy($id);

		return Redirect::route('attribute-sets.index');
	}

}
