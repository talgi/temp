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

    //DB::statement("SET SESSION time_zone = '".Config::get("app.timezone")."'");
	if (!Cache::has('seo_settings'))
	{
		$seo_settings = array(
			"seo_title"=>"",
			"seo_type"=>"",
			"seo_image" => "",
			"seo_site_name"=> "",
			"seo_desc" => "",
			"seo_keywords" => "",

		);
		
	 	Cache::forever('seo_settings',$seo_settings);
	}

	if (!Cache::has('site_settings'))
	{
		$site_settings = array(
			"site_logo"=>"",
			"site_favicon"=>""
		);
		
	 	Cache::forever('site_settings',$site_settings);
	}

	if (!Cache::has('site_analytics'))
	{
		$site_analytics = array(
			"analytics"=>"",
			"adwords"=>""
		);
		
	 	Cache::forever('site_analytics',$site_analytics);
	}

    if (!Cache::has('languages'))
    {
        $lang = array(
            "en"
        );

        Cache::forever('languages',$lang);
    }






    if(Input::get("lang") && in_array(Input::get("lang"), Cache::get("languages")))
    {
        Config::set("app.locale", Input::get("lang"));
    }


    Config::set("app.site_text",Cache::get("site_text_".Config::get("app.locale")));
	
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

Route::filter("admin",function(){
	
	$allowedUrls =  array(
		CMS_NAME.'/logout' ,
		CMS_NAME.'/login',
		CMS_NAME.'/register'
		);
	if(!((Auth::check() && Auth::user()->role == "admin" ) ||  in_array(Request::path(), $allowedUrls) ) ){
		return 	Redirect::to(CMS_NAME."/login");
	}

	

});

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest("/");
		}
	}
    else
    {
        // If the user is banned, immediately log out.
        if(Auth::check() && Auth::user()->banned)
        {
            Auth::logout();
            return Response::make('this account is banned', 401);


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
	if (Auth::check()) return Redirect::to('/');
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
