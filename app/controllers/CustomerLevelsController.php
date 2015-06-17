<?php

class CustomerLevelsController extends \BaseController {

	public function index(){

        $levels = CustomerLevel::where('site_id', SITE_ID);
        return View::make('customer-levels.index')
                     ->with('levels',$levels);

    }



}
