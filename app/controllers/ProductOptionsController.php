<?php

class ProductOptionsController extends \BaseController {

	# GET /options
	public function index()
	{
		$options = ProductOption::paginate();

		return View::make('options.index', compact('options'));
	}

	# GET /options/create
	public function create()
	{
		return View::make('options.create');
	}

	# POST /options
	public function store()
	{
		$validator = Validator::make($data = Input::all(), ProductOption::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		ProductOption::create($data);

		return Redirect::route('options.index');
	}

	# GET /options/{id}
	public function show($id)
	{
		$option = ProductOption::findOrFail($id);

		return View::make('options.show', compact('option'));
	}

	# GET /options/{id}/edit
	public function edit($id)
	{
		$option = ProductOption::find($id);

		return View::make('options.edit', compact('option'));
	}

	# PUT /options/{id}
	public function update($id)
	{
		$option = ProductOption::with('values')->findOrFail($id);

		$validator = Validator::make($data = Input::all(), ProductOption::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$option->update($data);

		return Redirect::route('options.index');
	}

	# DELETE /options/{id}
	public function destroy($id)
	{
		ProductOption::destroy($id);

		return [];
	}

}
