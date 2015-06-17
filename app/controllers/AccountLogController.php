<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-2-11
 * Time: 上午9:24
 */

class AccountLogController extends BaseController{

//    public function getList(){
//        $status = Input::get('status')?Input::get('status'):0;
//        $type = Input::get('type');
//        $account_logs = MerchantAccountLog::whereIn('status',get_account_log_status_arr($status));
//
//        isset($type) && !empty($type) ? $account_logs = $account_logs->whereHas('merchant',function($q) use ($type){
//            $q->where('merchant_grade',$type);
//        }) : '';
//        $account_logs = $account_logs->orderBy('updated_at')->paginate(10);
//        return View::make('accounts.index')
//                     ->with('account_logs',$account_logs)
//                     ->withInput(Input::all())
//                     ->with('status',$status)
//                     ->with('type',$type);
//    }

    public function getList(){
//        $status = Input::get('status')?Input::get('status'):0;
        $type = Input::get('type');
        $accounts = MerchantAccount::whereIn('status',get_account_log_status_arr(0));
        isset($type) && !empty($type) ? $accounts = $accounts->whereHas('merchant',function($q) use ($type){
            $q->where('merchant_grade',$type);
        }) : '';
        $accounts =    $accounts->orderBy('status','desc')->paginate(5);
        return View::make('accounts.index')
            ->with('accounts',$accounts)
            ->withInput(Input::all())
            ->with('type',$type);
    }

    public function getLogDetail($id){
        $account_logs = MerchantAccountLog::where('merchant_id',$id)->orderBy('created_at','desc')->paginate(6);
        return View::make('accounts.log',compact('account_logs'));
    }
} 