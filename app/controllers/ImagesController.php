<?php

class ImagesController extends \BaseController {

	protected $entity;
	protected $imageFolder;

	public function __construct(Image $image, ImageFolder $image_folder)
	{
		$this->entity = $image;
		$this->imageFolder = $image_folder;
	}

	# GET /images
	public function index()
	{
		$folder = Input::get('folder_id');

		$image_folders = $this->imageFolder->whereParentId($folder)->with('images')->get();

		$images = $this->entity->whereFolderId($folder)->paginate();

		return View::make('images.index', compact('images', 'image_folders'));
	}

	# GET /images/create
	public function create()
	{
		return View::make('images.create');
	}

	# POST /images
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Image::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Image::create($data);

		return Redirect::route('images.index');
	}

	# GET /images/{id}
	public function show($id)
	{
		$image = Image::findOrFail($id);

		return View::make('images.show', compact('image'));
	}

	# GET /images/{id}/edit
	public function edit($id)
	{
		$image = Image::find($id);

		return View::make('images.edit', compact('image'));
	}

	# PUT /images/{id}
	public function update($id)
	{
		$image = Image::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Image::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$image->update($data);

		return Redirect::route('images.index');
	}

	# DELETE /images/{id}
	public function destroy($id)
	{
		Image::destroy($id);

		return Redirect::route('images.index');
	}

}
