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
	//
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


// Có được truy cập vào trang admin?
Route::filter('admin-auth', function() {

	if(! Auth::check()) {
		return Redirect::route('signin');
	}

	if(!Fox::can('admin.access')) {
		return App::abort(403);
	}
});

Route::filter('auth', function()
{
	// Check if the user is logged in
	if ( ! Auth::check())
	{
		// Store the current uri in the session
		Session::put('loginRedirect', $_SERVER['REQUEST_URI']);

		// Redirect to the login page
		return Redirect::route('auth.login');
	}
});


Route::filter('auth.ajax', function()
{
	// Check if the user is logged in
	if ( ! Sentry::check())
	{
		return Response::json(['code' => 0, 'message' => 'Bạn cần đăng nhập để thực hiện tính năng này!']);
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
| Admin authentication filter.
|--------------------------------------------------------------------------
|
| This filter does the same as the 'auth' filter but it checks if the user
| has 'admin' privileges.
|
*/
require $app['path.base'] . '/app/admin_filters.php';


// Filter kiểm tra login ở waa.vn
Route::filter('root.login', function() {
	if(!Auth::check()) {
		return Redirect::route('auth.login');
	}
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
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
