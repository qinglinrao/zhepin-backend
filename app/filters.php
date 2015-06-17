<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    // Enable CORS 
    // In production, replace * with http://yourdomain.com 
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');

    if (Request::getMethod() == "OPTIONS") {
        // The client-side app can only set headers specified in Access-Control-Allow-Headers
        $headers = [
            'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers'=> 'X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization'
        ];
        return Response::make('You are connected to the API', 200, $headers);
    }
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    if(Auth::viaRemember()){

    }else{
        if (Auth::guest())
        {
            if (Request::ajax())
            {
                return Response::make('Unauthorized', 401);
            }
            else
            {
                return Redirect::guest('login');
            }
        }
    }

});

Route::filter('auto_login', function()
{
    if (Auth::guest())
    {
        Log::info('start login');
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            if(Cookie::has('auto_login')){
                Log::info('auto_login');
                $merchant_id = Cookie::get('auto_login');
                $merchant = Merchant::where('id',$merchant_id)->first();
                if($merchant){
                    Auth::login($merchant);
                }
            }
            return Redirect::guest('login');
        }
    }
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('orders');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


Route::filter('just-chrome',function(){

	if(Agent::browser() != 'Chrome' && !Config::get('app.debug')){
		return View::make('marionette.browser');
	}

});
