<?php
/*
|--------------------------------------------------------------------------
| Admin authentication filter.
|--------------------------------------------------------------------------
|
| This filter does the same as the 'auth' filter but it checks if the user
| has 'admin' privileges.
|
*/

Route::filter('admin-auth', function()
{
	// Check if the user is logged in
	if ( ! Auth::check())
	{
		// Store the current uri in the session
		Session::put('loginRedirect', $_SERVER['REQUEST_URI']);

		// Redirect to the login page
		return Redirect::route('signin');
	}

	// Check if the user has access to the admin page
	if ( ! Fox::can('admin.access') )
	{
		// Show the insufficient permissions page
		return App::abort(403);
	}

	setcookie('ssslogin_name', Auth::user()->email, time() + 86400, '/');

	$folder = $_SERVER['DOCUMENT_ROOT'] . '/source/' . md5(Auth::user()->email);

	if(!is_dir($folder)) {
		@mkdir($folder);
	}

});

/*
|--------------------------------------------------------------------------
| Admin permissions filter.
|--------------------------------------------------------------------------
|
*/
Route::filter('users.view', function($route, $request) {
	if(!Fox::can('users.view')) {
		return Redirect::back()->with('error', 'Bạn không có quyền thực hiện tác vụ này');
	}
});

Route::filter('users.edit', function($route, $request) {
	if(!Fox::can('users.edit')) {
		return Redirect::back()->with('error', 'Bạn không có quyền thực hiện tác vụ này');
	}
});

Route::filter('users.delete', function($route, $request) {
	if(!Fox::can('users.delete')) {
		return Redirect::back()->with('error', 'Bạn không có quyền thực hiện tác vụ này');
	}
});


