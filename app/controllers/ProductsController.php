<?php

class ProductsController extends \BaseController {

    protected $product;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    # POST /products/{status}
    public function status($status='online')
    {
        $visible = ['online'=>'0', 'offline'=>'1'];

        if($ids = Input::get('ids'))
        {
            Product::whereIn('id', $ids)->update(['visible'=>$visible[$status]]);
        }

        return Redirect::route('products.index', ['status'=>$status]);
    }

    # GET /products
    public function index($status='online')
    {
        $search = [
            'status' => Input::get('status'),
            'folder' => Input::get('folder'),
            'category' => Input::get('category'),
            'price'  => [
                'from'  => Input::get('price_from'),
                'to'    => Input::get('price_to')
            ],
            'name' => trim(Input::get('name'))
        ];

        $products = $this->entity->with('category', 'thumb')
            ->search($search)
            ->status($search['status'] ? $search['status'] : $status);

        $products = $products->latest()->paginate();

        $ng_category = '{{ category }}';

        return View::make('products.index', compact('products', 'search', 'ng_category', 'status'))
                        ->with('status',$search['status'] ? $search['status'] : $status);
    }

    # GET /products/create
    public function create()
    {
        $product = $this->entity;

        $ng_category = '{{ category }}';

        return View::make('products.create', compact('product', 'ng_category'));
    }

    # GET /products/{id}/copy
    public function copy($id)
    {
        $product = Product::findOrFail($id);

        return View::make('products.create', compact('product'));
    }

    # POST /products
    public function store()
    {
        $validator = Validator::make($data = Input::all(), Product::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data['note'] = '';
        $data['image_id'] = isset($data['images'][0]) ? $data['images'][0] : 0;
        $product = Product::create($data);
//		$product->services()->sync($data['services']);
        if(is_array($data['images'])) $product->images()->sync($data['images']);

        return Redirect::route('products.index');
    }

    # GET /products/{id}
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return View::make('products.show', compact('product'));
    }

    # GET /products/{id}/edit
    public function edit($id)
    {
        $product = Product::with('images')->find($id);

        $options = ProductOption::with('values')->get();

        $ng_category = '{{ category }}';

        return View::make('products.edit', compact('product', 'options', 'ng_category'));
    }

    # PUT /products/{id}
    public function update($id)
    {


        $product = Product::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Product::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if(isset($data['images'][0])){
            $data['image_id'] = $data['images'][0];
        }

        $product->update($data);
//		$product->services()->sync($data['services']);
        if(is_array($data['images'])) $product->images()->sync($data['images']);

        return Redirect::route('products.index');
    }

    # DELETE /products/{id}
    public function destroy($id)
    {
        return Product::destroy($id);
    }

}
