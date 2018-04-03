<?php
if(@$_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
	date_default_timezone_set('Asia/Ho_Chi_Minh');
}

// Register Login an instance
App::instance('login', new Login);

// Register Follow with Singleton
App::singleton('follow', function(){
	return new Follow;
});

App::singleton('metadata', function() {
	return new Metadata;
});

App::singleton('domain', function(){
	return Route::getCurrentRoute()->getParameter('account');
});


/*
|--------------------------------------------------------------------------
| My Events subcrible
|--------------------------------------------------------------------------
*/
require $app['path.base'] . '/app/events.php';
require $app['path.base'] . '/app/fpmacro.php';