<?php

Route::group(['prefix' => 'auth'], function() {
	# Admin login
	Route::get('signin', ['as' => 'signin', 'uses' => 'AuthController@getSignin']);
	Route::post('signin', 'AuthController@postSignin');
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);

	// Đăng nhập người dùng
	Route::get('login', ['as' => 'auth.login', 'uses' => 'LoginController@getLogin']);
	Route::post('login', 'LoginController@postLogin');

	# Đăng ký người dùng
	Route::get('register', ['as' => 'user/register', 'uses' => 'RegisterController@getRegister']);
	Route::post('register', ['as' => 'post/register', 'uses' => 'RegisterController@postRegister']);
	Route::get('/register-success/{email}', ['as' => 'register.success', 'uses' => 'RegisterController@getSuccess']);
	Route::get('/active-success/{email}', ['as' => 'active.success', 'uses' => 'RegisterController@getActiveSuccess']);
	Route::get('/active', ['as' => 'active-user', 'uses' => 'RegisterController@getActivate']);
});

Route::group(['prefix' => 'account'], function() {

	Route::group(['prefix' => 'tour', 'namespace' => 'Controllers\Account'], function() {
		Route::get('/', ['as' => 'account.tour.index', 'uses' => 'ToursController@getIndex']);

		Route::get('edit/{id?}', [
			'as' 		=> 'account.tour.edit',
			'uses' 	=> 'ToursController@getEdit'
		]);

		Route::post('edit/{id?}',	'ToursController@getEdit');

		Route::get('/photo/{id}-{name}', [
			'as' 		=> 'account.tour.photo',
			'uses' 	=> 'ToursController@getPhotoTour'
		]);

		Route::get('/delete/{id}', [
			'as' 		=> 'account.tour.delete',
			'uses' 	=> 'ToursController@getDelete'
		]);

		Route::get('/photo/delete/{id}', [
			'as' => 'account.photo.delete',
			'uses' => 'ToursController@getDeletePhoto'
		]);
	});

	Route::group(['prefix' => 'booking', 'namespace' => 'Controllers\Account'], function() {
		Route::get('/', ['as' => 'account.booking.index', 'uses' => 'BookingController@getIndex']);
		Route::get('edit/{id?}', [
			'as'     => 'account.booking.edit',
			'uses'   => 'BookingController@getEdit'
		]);
		Route::get('confirm/{id?}', [
			'as'     => 'account.booking.confirm',
			'uses'   => 'BookingController@getConfirm'
		]);
		Route::get('/{bookingId}/change-status', [
		   'as'     => 'account.booking.change.status',
			'uses'   => 'BookingController@changeStatus'
		]);

		Route::get('/me', ['as' => 'account.booking.me', 'uses' => 'BookingController@getMyBooking']);
	});

	Route::group(['prefix' => 'profile', 'namespace' => 'Controllers\Account'], function() {
		Route::get('/', ['as' => 'profile.index', 'uses' => 'ProfileController@getIndex']);
		Route::post('/', 'ProfileController@postProfile');
		Route::get('/changepassword', ['as' => 'profile.changepassword', 'uses' => 'ProfileController@getChangepassword']);
		Route::post('/changepassword', 'ProfileController@postChangepassword');
	});
});