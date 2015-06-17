<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-1-28
 * Time: 下午2:01
 */


class SystemConfigController extends BaseController{

    /**
     * 跳转向支付配置页
     * @return $this
     */
    public function getPaySetting(){
        $payment = array(
            'alipay_account' => '',
            'partner' => '',
            'sign_type'=>'',
            'expiry_minutes'=>'',
            'key'=>''
        );

        $site = Site::where('merchant_id', MERCHANT_ID)->first();
        if($site && $site->payment) {
            $payment = json_decode($site->payment);
        }
        return View::make('system-configs.pay_setting')->with('payment',$payment);
    }

    /**
     * 提交支付配置信息
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postPaySetting()
    {
        $payment = Input::get('payment');
        $site = Site::where('merchant_id', MERCHANT_ID)->first();
        $site->payment = json_encode($payment);

        if($site->save()) {
            return Redirect::route('pay_setting');
        } else {
            return Redirect::route('pay_setting')->withInput()->withErrors(array('error'=>'支付配置修改失败'));
        }
    }
}

