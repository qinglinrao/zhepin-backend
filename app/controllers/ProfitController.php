<?php

class ProfitController extends BaseController{

    /**
     * 跳转向产品分润规则模板页
     * @return $this
     */
    public function getIndex(){

        $profits = ProductProfit::with('products')->get();
        return View::make('profits.index')->with('profits',$profits);
    }

    /**
     * 删除分润规则模板
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function getDelete($id){
        $profit = ProductProfit::where('id',$id)->delete();
        return Redirect::route('profit.index');

    }



} 