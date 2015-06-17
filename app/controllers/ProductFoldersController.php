<?php

class ProductFoldersController extends \BaseController {

	# GET /folders
	public function index()
	{
		$folders = Productfolder::paginate();

		return View::make('folders.index', compact('folders'));
	}

	# GET /folders/create
	public function create()
	{
		return View::make('folders.create');
	}

	# POST /folders
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Productfolder::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Productfolder::create($data);

		return Redirect::route('folders.index');
	}

	# GET /folders/{id}
	public function show($id)
	{
		$folder = Productfolder::with('products.thumb')->findOrFail($id);

		return View::make('folders.show', compact('folder'));
	}

	# GET /folders/{id}/edit
	public function edit($id)
	{
		$folder = Productfolder::find($id);

		return View::make('folders.edit', compact('folder'));
	}

	# PUT /folders/{id}
	public function update($id)
	{
		$folder = Productfolder::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Productfolder::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$folder->update($data);

		return Redirect::route('folders.index');
	}

	# DELETE /folders/{id}
	public function destroy($id)
	{
		Productfolder::destroy($id);

		return Redirect::route('folders.index');
	}

}
