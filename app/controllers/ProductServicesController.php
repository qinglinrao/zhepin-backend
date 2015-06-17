<?php

class ProductServicesController extends \BaseController {

	public function __construct(ProductService $product_service)
	{
		$this->entity = $product_service;
	}

	# GET /product-services
	public function index()
	{
		$query = trim(Input::get('query'));

		$services = $this->entity;

		if($query)
			$services = $services->where('name', 'like', '%'.$query.'%');

		$services = $services->paginate();

		return View::make('product-services.index', compact('services', 'query'));
	}

	# GET /product-services/create
	public function create()
	{
		return View::make('product-services.create');
	}

	# POST /product-services
	public function store()
	{
		$validator = Validator::make($data = Input::all(), ProductService::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		ProductService::create($data);

		return Redirect::route('product-services.index');
	}

	# GET /product-services/{id}
	public function show($id)
	{
		$service = ProductService::findOrFail($id);

		return View::make('product-services.show', compact('service'));
	}

	# GET /product-services/{id}/edit
	public function edit($id)
	{
		$service = ProductService::find($id);

		return View::make('product-services.edit', compact('service'));
	}

	# PUT /product-services/{id}
	public function update($id)
	{
		$service = ProductService::findOrFail($id);

		$validator = Validator::make($data = Input::all(), ProductService::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$service->update($data);

		return Redirect::route('product-services.index');
	}

	# DELETE /product-services/{id}
	public function destroy($id)
	{
		ProductService::destroy($id);

		return Redirect::route('product-services.index');
	}

}
