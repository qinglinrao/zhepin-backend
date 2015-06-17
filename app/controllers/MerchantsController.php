<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-1-27
 * Time: 下午5:30
 */

class MerchantsController extends  BaseController{

    # GET /merchants/login
    /**
     * 跳转向商家登录页面
     * @return \Illuminate\View\View
     */
    public function getLogin(){
        return View::make('customers.login');
    }

    /**
     * 商家登录操作
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(){
        $data = array(
            'mobile' => Input::get('mobile'),
            'password' => Input::get('password'),
            'authcode' => Input::get('authcode'),
            'auto_login' => Input::get('auto_login')
        );
        $rules = array(
            'mobile' =>'required|cnphone',
            'password' => 'required',
            'authcode' => 'required|validate_code'
        );
        $messages = array(
            'mobile.required' => '请填写手机号',
            'mobile.cnphone' => '请填写正确格式的手机号',
            'password.required' => '请填写密码!',
            'authcode.required' => '请填写验证码!',
            'authcode.validate_code' => '验证码填写错误!'
        );
        $v = Validator::make($data, $rules, $messages);
        if ($v->fails()) {
            return Redirect::route('merchants.login')->withInput()->withErrors(array('error'=>$v->messages()->first()));
        }else{
            $merchant = Merchant::where('mobile',$data['mobile'])->first();
            if(!$merchant){
                return Redirect::route('merchants.login')->withInput()->withErrors(array('error'=>'您的帐号不存在!'));
            }else if(!$merchant->confirmed){
                return Redirect::route('merchants.login')->withInput()->withErrors(array('error'=>'您的帐号还未激活!'));
            }
            else if(!Hash::check($data['password'], $merchant->encrypted_password)){
                return Redirect::route('merchants.login')->withInput()->withErrors(array('error'=>'密码错误!'));
            }else{
                Auth::login($merchant);
                if($data['auto_login']){
                    $cookie = Cookie::make('auto_login',$merchant->id,60*24*3);
                    return Redirect::route('orders.index')->withCookie($cookie);
                }else{
                    return Redirect::route('orders.index');
                }
            }

        }

    }

    public function getRegister(){
        $industries = Industry::all();
        return View::make('customers.register')->with('industries',$industries);
    }

    public function postRegister(){
        $data = array(
            'mobile' => Input::get('mobile'),
            'password' => Input::get('password'),
            'authcode' => Input::get('authcode'),
            'industry' => Input::get('industry')
        );

        $rules = array(
            'mobile' =>"required|cnphone|unique:merchants,mobile",
            'authcode' => "required|phone_verify_code:{$data['mobile']}",
            'password' => 'required|password:6,20',
            'industry' => 'required'
        );
        $messages = array(
            'mobile.required' => '请填写手机号',
            'mobile.cnphone' => '请填写正确格式的手机号',
            'mobile.unique' => '此手机号已注册过',
            'authcode.required' => '请填写验证码',
            'password.required' => '请填写密码',
            'password.password' => '密码由6-20位数字,字母,符号组成',
            'authcode.phone_verify_code' => '验证码错误或已失效',
            'industry.required' => '请选择所经营的行业'
        );

        $v = Validator::make($data, $rules, $messages);

        if ($v->fails()) {
            return Redirect::route('merchants.register')->withInput()->withErrors(array('error'=>$v->messages()->first()));
        }else{
            DB::beginTransaction();
            try{
                $merchat = new Merchant();
                $merchat->username = $data['mobile'];
                $merchat->mobile = $data['mobile'];
                $merchat->encrypted_password = Hash::make($data['password']);
                $merchat->confirmed = 1;
                $merchat->industry_id = $data['industry'];
                $merchat->save();
                DB::commit();
                return Redirect::route('orders.index');
            }catch (Exception $e){
                DB::rollback();
                return Redirect::route('merchants.register')->withInput()->withErrors(array('error'=>$v->messages()->first()));
            }



        }
    }



    public function postAuthCode(){

        $data = array(
            'mobile' => Input::get('mobile')
        );

        $rules = array(
            'mobile' =>"required|cnphone",
        );

        $messages = array(
            'mobile.required' => '请填写手机号',
            'mobile.cnphone' => '请填写正确格式的手机号',
        );

        $v = Validator::make($data, $rules, $messages);

        if ($v->fails()) {
            $result['state'] = 0;
            $result['msg'] = $v->messages()->first();
        }else{
            $hasSent = AuthCode::type('mobile')->mobile(Input::get('phone'))->valid()->count();
            if($hasSent <= Config::get('app.verify_phone_time')){

                $mobiles[] = $data['mobile'];
                $code = rand(100000,999999);
                $content = Yimei::getContent($code);
                $sendState = Yimei::sendSMS($mobiles,$content);

                if($sendState === '0'){
                    $result['state'] = 1;
                }else{
                    $result['state'] = 0;
                    $result['msg'] = "验证码发送失败($sendState)";
                }

                $authCode = new AuthCode();
                $authCode->email = 'test';
                $authCode->mobile = $data['mobile'];
                $authCode->type= 'mobile';
                $authCode->code = $code;
                $authCode->state = $sendState;

                $authCode->save();

            }else{
                $result['state'] = 0;
                $result['msg'] = "发送时间小于时间间隔限制！";
            }
        }
        return Response::json($result);

    }

    /**
     * @param $type => merchant_grade 商家类型 (1:代理商 2:门店 3:BA)
     * @return mixed 根据商家类型 merchant_grade 来查询不同类型的商家列表
     */
    public function getMerchants($type){

        //获取排序列名和排序值
        //排序列(total_pay,follower_num,money)
        //排序值(asc,desc)
        $sort_name = Input::get('sort_name')?Input::get('sort_name'):'total_pay';
        $sort_val= Input::get('sort_val')?Input::get('sort_val'):'desc';

        //当BA选折以follower_num来排序时,将列名改为customer_num,
        //因为 BA在页面中显示的是客户数量 而不是下线数量
        if($type ==3 && $sort_name == "follower_num") $sort_name = 'customer_num';

        //搜索模糊查询 (用户名或手机号码)
        $query = trim(Input::get('query'));
        $merchants = Merchant::with('image','leader','follower')->where('merchant_grade',$type);
        isset($query) && !empty($query) ? $merchants = $merchants->where(function($q) use($query){
            $q->where('username','like','%'.$query.'%')->orWhere('mobile','like','%'.$query.'%');
        }) : '';

        //排序并分页
        $merchants = $merchants->orderBy($sort_name,$sort_val)->orderBy('created_at','desc');

        //因为页面中标注的是follower_num ，此时将排序列重置为follower_num
        if($type ==3 && $sort_name == "customer_num") $sort_name = 'follower_num';

        $merchants = $merchants->paginate(15);
        return View::make('profits.merchants')
                    ->with('merchants',$merchants)
                    ->with('sort_name',$sort_name)
                    ->with('sort_val',$sort_val)
                    ->with('type',$type)
                    ->withInput(Input::all());
    }

    /**
     * 改变商家的状态 (0：拒绝入驻,1:入驻待审核,2:同意入驻,3:冻结账户)
     * 这里只能1->0 或 1->2 或 2->3 或 3->2
     * @param $id
     * @param $status
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getChangeStatus($id,$status){
        $merchant = Merchant::where('id',$id)->first();
        if($merchant){

            if($merchant->status == 1 && $status == 2 ){
                if($merchant->merchant_grade == 1){
                    $sendState = Yimei::sendSMS([$merchant->mobile],'【UNES优理氏】您好，您的入驻申请已审核通过！请及时登录修改密码！');
                }else{
                    $sendState = Yimei::sendSMS([$merchant->mobile],'【UNES优理氏】您好，您的入驻申请已审核通过,登录初始密码为您填写的手机号码后六位！请及时登录修改密码！');
                }
                if($sendState === '0'){
                    $merchant->status = $status;
                }
            }
            else if($merchant->status == 1 && $status == 0 ){
                $sendState = Yimei::sendSMS([$merchant->mobile],'【UNES优理氏】您好，您的入驻申请未通过,您可以重填资料再次申请！');
                if($sendState === '0'){
                    $merchant->status = $status;
                    $merchant->visible = 0;
                }
            }
            else{
                $merchant->status = $status;
            }
            if($merchant->save()){
                return Redirect::back();
            }else{
                return Redirect::back()->withErrors(array('error'=>'系统错误!'));
            }
        }else{
            return Redirect::back()->withErrors(array('error'=>'没有找到该记录!'));
        }
    }

    /**
     * 根据商家编号 删除商家信息
     * @param $id 商家编号
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getDelete($id){
        $merchant = Merchant::where('id',$id)->first();
        if($merchant){
            if($merchant->delete()){
                return Redirect::back();
            }else{
                return Redirect::back()->withErrors(array('error'=>'系统错误!'));
            }
        }else{
            return Redirect::back()->withErrors(array('error'=>'没有找到该记录!'));
        }
    }

    /**批量删除商家信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function postBatchDelete(){
        //商家编号数组字符串，形如"1,2,3,4,5"
        $ids = Input::get('ids');
        if($ids){
            DB::beginTransaction();
            try{
                //将字符串转为数组
                $merchant_ids = explode(",",$ids);
                Merchant::whereIn('id',$merchant_ids)->delete();
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

    /**
     * 跳转向添加代理商页面
     * @return \Illuminate\View\View
     */
    public function getAdd(){
        return View::make('profits.create');
    }

    /**
     * 执行添加代理商操作
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postCreate(){
        $data = array(
            'mobile' => Input::get('mobile'),
            'password' => Input::get('password'),
        );

        $rules = array(
            'mobile' =>"required|cnphone|unique:merchants,mobile",
            'password' => 'required|password:6,20'
        );
        $messages = array(
            'mobile.required' => '请填写手机号',
            'mobile.cnphone' => '请填写正确格式的手机号',
            'mobile.unique' => '此手机号已注册过',
            'password.required' => '请填写密码',
            'password.password' => '密码由6-20位数字,字母,符号组成'
        );

        $v = Validator::make($data, $rules, $messages);

        if ($v->fails()) {
            return Redirect::route('merchants.add')->withInput()->withErrors(array('error'=>$v->messages()->first()));
        }else{
            DB::beginTransaction();
            try{
                $merchant = new Merchant();
                $merchant->username = $data['mobile'];
                $merchant->mobile = $data['mobile'];
                $merchant->encrypted_password = Hash::make($data['password']);
                $merchant->status = 2;
                $merchant->merchant_grade = 1;
                $merchant->leader_id = 0;
                $merchant->remember_token = '';
                $merchant->save();
                DB::commit();
                return Redirect::route('profit.merchants',array('type'=>1));
            }catch (Exception $e){
                Log::info('错误!');
                DB::rollback();
                Log::info($e->getMessage());
                return Redirect::route('merchants.add')->withInput()->withErrors(array('error'=>'系统错误!稍后再试!'));
            }

        }
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getDetail($id){
        $from_id = Input::get('from');
//        $leader_id = Input::get('leader');
        $leader = Merchant::where('id',$id)->first();
        $fromer = Merchant::where('id',$from_id)->first();
        $merchants = Merchant::where('leader_id',$id);

        $show_customer = Input::get('sc')==1?1:0;
        //当前商家为BA时,其下线显示的是顾客
        if($leader->merchant_grade == 3 || $show_customer){
            //排序并分页
            $sort_name = Input::get('sort_name')?Input::get('sort_name'):'order_total_pay';
            $sort_val= Input::get('sort_val')?Input::get('sort_val'):'desc';

            $customers  =  $leader->customers()->orderBy($sort_name,$sort_val)->paginate(15);
            return View::make('profits.customer_detail')
                        ->with('customers',$customers)
                        ->with('leader',$leader)
                        ->with('fromer',$fromer)
                        ->with('sort_name',$sort_name)
                        ->with('sort_val',$sort_val)
                        ->with('sc',$show_customer);
        }else{
            //排序并分页
            //获取排序列名和排序值
            //排序列(total_pay,follower_num,money)
            //排序值(asc,desc)
            $sort_name = Input::get('sort_name')?Input::get('sort_name'):'total_pay';
            $sort_val= Input::get('sort_val')?Input::get('sort_val'):'desc';
            //当BA选折以follower_num来排序时,将列名改为customer_num,
            //因为 BA在页面中显示的是客户数量 而不是下线数量
            if($leader->merchant_grade ==2 && $sort_name == "follower_num") $sort_name = 'customer_num';
            $merchants = $merchants->orderBy($sort_name,$sort_val);
            if($leader->merchant_grade ==2 && $sort_name == "customer_num") $sort_name = 'follower_num';
            $merchants = $merchants->paginate(15);
            return View::make('profits.merchant_detail')
                ->with('leader',$leader)
                ->with('fromer',$fromer)
                ->with('merchants',$merchants)
                ->with('sort_name',$sort_name)
                ->with('sort_val',$sort_val)
                ->withInput(Input::all())
                ->with('sc',$show_customer);
        }

    }

    /**
     * 提现记录列表
     * @param $id
     * @return $this
     */
    public function getAccountLog($id){
        $leader = Merchant::where('id',$id)->first();
        $account_logs = MerchantAccountLog::where('merchant_id',$id)->orderBy('updated_at')->paginate(10);
        return View::make('profits.account_log')
                    ->with('leader',$leader)
                    ->with('account_logs',$account_logs);
    }


    /**
     * 查看身份证正反面照片
     */
    public function getShowIdentityCard(){
        $id = Input::get('id');
        $account_log = MerchantAccountLog::where('id',$id)->first();
        if($account_log){
            return View::make('profits.identity_card_check')->with('account_log',$account_log);
        }else{
            return View::make('profits.identity_card_check')->with('account_log',$account_log);
        }

    }


    /**
     * 处理商家余额提现 (定时转账)
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function dealCustomerProfitApply($id){
        $merchant = Merchant::where('id',$id)->first();
        if($merchant && $merchant->money > 0){
            try{
                DB::beginTransaction();
                $this->addProfitLog($merchant);
                DB::commit();
                return Redirect::back();
            }catch (Exception $e){
                Log::info($e->getMessage());
                DB::rollBack();
            }
        }else{
            return Redirect::back()->withErrors(array('error'=>'非法操作!'));
        }
    }


    /**
     * 添加商家账户分润日志
     * @param $merchant 商家
     */

    public function addProfitLog($merchant){
        Log::info('日志结论落脚点刘德');
        $account = $merchant->account;
        $admin = Auth::user();
        Log::info($admin);
        if($account){
            $account_log = new MerchantAccountLog();
            $account_log->money = $merchant->money;
            $account_log->trade_type = 0; //交易类别 0:支出  1:收入
            $account_log->operate_type = 1; //操作类别 1:提现 2:佣金
            $account_log->merchant_id = $merchant->id;
//            $account_log->bank_account_id = $account->bank_account_id;
//            $account_log->bank_account_name = $account->bank_account_name;
//            $account_log->bank_name = $account->bank_name;
//            $account_log->identity_up_image_id = $account->identity_up_image_id;
//            $account_log->identity_down_image_id = $account->identity_down_image_id;

            $account_log->alipay_account = $account->alipay_account;
            $account_log->alipay_name = $account->alipay_name;


            $account_log->status = 2;
            $account_log->log = '后台管理员(ID:'.$admin->id.',mobile:'.$admin->mobile.')将余额￥'.$merchant->money.'转入客户账户';
            $account_log->save();
            $merchant->money = 0;
            $merchant->save();
        }else{
            Log::info('没有找到账户');
        }
    }


//    /**
//     * 同意或拒绝提现申请
//     * @param $id
//     * @param $status
//     * @return \Illuminate\Http\RedirectResponse
//     */
//    public function getChangeAccountStatus($id,$status){
//        $log = MerchantAccountLog::where('id',$id)->first();
//        if($log){
//            $merchant = $log->merchant;
//            if(account_log_action_right($log,$status)){
//                try{
//                    DB::beginTransaction();
//                    $log->status = $status;
//                   $log->save();
//
//
//
////                    if($status == 0){
////                        $merchant->money += $log->money;
////                        $merchant->save();
////                    }else if($status == )
//                    DB::commit();
//                    return Redirect::back();
//                }catch (Exception $e){
//                    DB::rollBack();
//                    return Redirect::back()->withErrors(array('error'=>'系统错误!'));
//                }
//            }else{
//                return Redirect::back()->withErrors(array('error'=>'非法操作!'));
//            }
//        }else{
//            return Redirect::back()->withErrors(array('error'=>'记录不存在!'));
//        }
//    }




} 