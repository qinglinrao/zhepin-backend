<?php

class AttributesController extends \BaseController {

	# GET /attributes
	public function index()
	{
		$attributes = CategoryAttribute::paginate();

		return View::make('attributes.index', compact('attributes'));
	}

	# GET /attributes/create
	public function create()
	{
		return View::make('attributes.create');
	}

	# POST /attributes
	public function store()
	{
		$validator = Validator::make($data = Input::all(), CategoryAttribute::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		CategoryAttribute::create($data);

		return Redirect::route('attributes.index');
	}

	# GET /attributes/{id}
	public function show($id)
	{
		$attribute = CategoryAttribute::findOrFail($id);

		return View::make('attributes.show', compact('attribute'));
	}

	# GET /attributes/{id}/edit
	public function edit($id)
	{
		$attribute = CategoryAttribute::find($id);

		return View::make('attributes.edit', compact('attribute'));
	}

	# PUT /attributes/{id}
	public function update($id)
	{
		$attribute = CategoryAttribute::findOrFail($id);

		$validator = Validator::make($data = Input::all(), CategoryAttribute::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$attribute->update($data);

		return Redirect::route('attributes.index');
	}

	# DELETE /attributes/{id}
	public function destroy($id)
	{
		CategoryAttribute::destroy($id);

		return Redirect::route('attributes.index');
	}

}
