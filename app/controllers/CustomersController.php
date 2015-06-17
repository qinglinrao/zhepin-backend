<?php

class CustomersController extends \BaseController {

	protected $customer;

	public function __construct(Customer $customer)
	{
		$this->customer = $customer;
	}

	# GET /customers
	public function index()
	{
        $query = Input::get('query');
        $email = Input::get('email');
        $telephone = Input::get('telephone');
        $last_login_time = Input::get('last_login_time');
        $register_time = Input::get('register_time');

        $group = Input::get('group');

		$customers = Customer::with('level','groups','customerGroup');

        isset($query) && !empty($query) ? $customers = $customers->where(function($q) use ($query){
            $q->where('mobile','like','%'.$query.'%')
              ->orWhere('username','like','%'.$query.'%');
        }) : '' ;

        isset($email) && !empty($email) ? $customers = $customers->where('email','like','%'.$email.'%') : '';
        isset($telephone) && !empty($telephone) ? $customers = $customers->where('mobile','like','%'.$telephone.'%') : '' ;
        isset($last_login_time) && !empty($last_login_time) ? $customers = $customers->where(function($q) use($last_login_time){
            if(isset($last_login_time['from']) && !empty($last_login_time['from']))
                $q->where('last_sign_in_at','>=',$last_login_time['from']);
            if(isset($last_login_time['to']) && !empty($last_login_time['to']))
                $q->where('last_sign_in_at','<=',$last_login_time['to']);

        }) : '';

        isset($register_time) && !empty($register_time) ? $customers = $customers->where(function($q) use($register_time){
            if(isset($register_time['from']) && !empty($register_time['from']))
                $q->where('last_sign_in_at','>=',$register_time['from']);
            if(isset($register_time['to']) && !empty($register_time['to']))
                $q->where('last_sign_in_at','<=',$register_time['to']);

        }) : '';

        isset($group) && !empty($group) ? $customers = $customers->whereHas('customerGroup',function($query) use($group){
            $query->where('group_id',$group);
        }) : '' ;

        $customers = $customers->paginate();
		return View::make('customers.index', compact('customers'))
                     ->withInput(Input::all())
                     ->with('query',$query)
                     ->with('email',$email)
                     ->with('telephone',$telephone)
                     ->with('last_login_time',$last_login_time)
                     ->with('register_time',$register_time)
                     ->with('group',$group);
	}

	# GET /customers/create
	public function create()
	{
		return View::make('customers.create');
	}

	# POST /customers
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Customer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Customer::create($data);

		return Redirect::route('customers.index');
	}

	# GET /customers/{id}
	public function show($id)
	{
        $customer = Customer::with('detail','orders')->find($id);
        $orders = CustomerOrder::where('customer_id',$customer->id)->paginate(5);
        return View::make('customers.detail')
                    ->with('customer',$customer)
                    ->with('orders',$orders)
                    ->withInput(Input::all());
	}

	# GET /customers/{id}/edit
	public function edit($id)
	{
		$customer = Customer::find($id);

		return View::make('customers.edit', compact('customer'));
	}

	# PUT /customers/{id}
	public function update($id)
	{
		$customer = Customer::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Customer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$customer->update($data);

		return Redirect::route('customers.index');
	}

	# DELETE /customers/{id}
	public function destroy($id)
	{
		Customer::destroy($id);

		return Redirect::route('customers.index');
	}


    #POST /customers/batch_delete
    /**批量删除顾客信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function postBatchDelete(){
        //顾客编号数组字符串，形如"1,2,3,4,5"
        $ids = Input::get('ids');
        if($ids){
            DB::beginTransaction();
            try{
                //将字符串转为数组
                $customer_ids = explode(",",$ids);
                Customer::whereIn('id',$customer_ids)->delete();
                DB::commit();
                return Response::json(array('result'=>1));
            }catch (Exception $e){
                DB::rollBack();
                return Response::json(array('result'=>0));
            }
        }else{
            return Response::json(array('result'=>0));
        }

    }








}
