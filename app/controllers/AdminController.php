<?php


class AdminController  extends BaseController{

    /**
     * 跳转到管理员登录界面
     * @return \Illuminate\View\View
     */
    public function getLogin(){
        return View::make('admins.login');
    }

    /**
     * 管理员登录操作
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(){
        $data = Input::get('admin');
        $rules = array(
            'mobile' =>'required|phoneoremail',
            'password' => 'required',
            'authcode' => 'required|validate_code'
        );
        $messages = array(
            'mobile.required' => '请填写手机号',
            'mobile.phoneoremail' => '请填写正确格式的邮箱地址/手机号',
            'password.required' => '请填写密码!',
            'authcode.required' => '请填写验证码!',
            'authcode.validate_code' => '验证码填写错误!'
        );
        $v = Validator::make($data, $rules, $messages);
        if ($v->fails()) {
            return Redirect::route('admin.login')->withInput()->withErrors(array('error'=>$v->messages()->first()));
        }else{
            $admin = Admin::where('mobile',$data['mobile'])->orWhere('email',$data['mobile'])->first();
            if(!$admin){
                return Redirect::route('admin.login')->withInput()->withErrors(array('error'=>'您的帐号不存在!'));
            }
            else if(!Hash::check($data['password'], $admin->password)){
                return Redirect::route('admin.login')->withInput()->withErrors(array('error'=>'密码错误!'));
            }else{
                //记住密码功能
                if($data['auto_login']){
                    //attempt成功后，须手动登出才会失效
                    Auth::attempt(array('mobile'=>$admin->mobile,'password'=>$data['password']),true);
                }else{
                    Auth::login($admin);
                }
                return Redirect::route('orders.index');
            }

        }
    }

    /**
     * 后台管理员退出登录
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout(){

        Auth::logout();
        return Redirect::route('admin.login');
    }

    /**
     * 图片验证码 输出流
     *  将验证码存储到Session中
     */
    public function getValidateCodeImage(){
        $validate_code = new ValidateCode();      //实例化一个对象
        $validate_code->doimg();
        Session::put('validate_code',$validate_code->getCode());//验证码保存到SESSION中
    }
} 