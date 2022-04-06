<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(['prefix' => 'admin'], function() {
	# User Management
	Route::group(['prefix' => 'users'], function() {
		Route::get('/', ['as' => 'users', 'before' => 'users.view' ,'uses' => 'Controllers\Admin\UsersController@getIndex']);
		Route::get('create', ['as' => 'create/user' ,'uses' => 'Controllers\Admin\UsersController@getCreate']);
		Route::post('create', ['before' => 'users.add', 'uses' => 'Controllers\Admin\UsersController@postCreate']);

		Route::get('{userId}/edit', ['as' => 'update/user', 'uses' => 'Controllers\Admin\UsersController@getEdit']);
		Route::post('{userId}/edit', [
			'before' => 'users.edit',
			'uses' => 'Controllers\Admin\UsersController@postEdit'
		]);

		Route::get('{userId}/delete', [
			'as' => 'delete/user',
			'before' => 'users.delete',
			'uses' => 'Controllers\Admin\UsersController@getDelete'
		]);

		Route::get('{userId}/restore', ['as' => 'restore/user', 'uses' => 'Controllers\Admin\UsersController@getRestore']);

		Route::get('{userId}/active', ['as' => 'active/user', 'uses' => 'Controllers\Admin\UsersController@getActive']);

		// Fake login
		Route::get('{userId}/fake-login', [
		  'as' => 'admin/user/fake-login',
		  'before' => 'users.fake_login',
		  'uses' => 'Controllers\Admin\UsersController@getFakeLogin'
		]);
	});

	# Module Management
	Route::group(['prefix' => 'modules'], function() {
		Route::get('/', ['as' => 'modules', 'uses' => 'Controllers\Admin\ModulesController@getIndex']);
		Route::get('create', ['as' => 'create/modules', 'uses' => 'Controllers\Admin\ModulesController@getCreate']);
		Route::post('create', 'Controllers\Admin\ModulesController@postCreate');
		Route::get('{moduleId}/edit', ['as' => 'edit/modules', 'uses' => 'Controllers\Admin\ModulesController@getEdit']);
		Route::post('{moduleId}/edit', 'Controllers\Admin\ModulesController@postEdit');
		Route::get('{moduleId}/delete', ['as' => 'delete/modules', 'uses' => 'Controllers\Admin\ModulesController@getDelete']);
		Route::get('{moduleId}/active', ['as' => 'active/modules', 'uses' => 'Controllers\Admin\ModulesController@getActive']);
	});

	# Setting Management
	Route::group(['prefix' => 'setting'], function() {
		Route::get('/', ['as' => 'setting', 'uses' => 'Controllers\Admin\SettingsController@getIndex']);
		Route::post('/', 'Controllers\Admin\SettingsController@postIndex');
	});

	# Category Management
	Route::group(['prefix' => 'categories'], function() {
		Route::get('/', ['as' => 'categories', 'uses' => 'Controllers\Admin\CategoriesController@getIndex']);
		Route::get('create', ['as' => 'create/categories', 'uses' => 'Controllers\Admin\CategoriesController@getCreate']);
		Route::post('create', 'Controllers\Admin\CategoriesController@postCreate');
		Route::get('{moduleId}/edit', ['as' => 'edit/categories', 'uses' => 'Controllers\Admin\CategoriesController@getEdit']);
		Route::post('{moduleId}/edit', 'Controllers\Admin\CategoriesController@postEdit');
		Route::get('{moduleId}/delete', ['as' => 'delete/categories', 'uses' => 'Controllers\Admin\CategoriesController@getDelete']);
		Route::get('{moduleId}/active', ['as' => 'active/categories', 'uses' => 'Controllers\Admin\CategoriesController@getActive']);
	});

	Route::group(['prefix' => 'backgrounds'], function() {
		Route::get('/', ['as' => 'backgrounds', 'uses' => 'Controllers\Admin\BackgroundsController@getIndex']);
		Route::get('create', ['as' => 'create/backgrounds', 'uses' => 'Controllers\Admin\BackgroundsController@getCreate']);
		Route::post('create', 'Controllers\Admin\BackgroundsController@postCreate');
		Route::get('edit', ['as' => 'edit/backgrounds', 'uses' => 'Controllers\Admin\BackgroundsController@getEdit']);
		Route::post('edit', 'Controllers\Admin\BackgroundsController@postEdit');
		Route::get('delete', ['as' => 'delete/backgrounds', 'uses' => 'Controllers\Admin\BackgroundsController@getDelete']);
		Route::get('active', ['as' => 'active/backgrounds', 'uses' => 'Controllers\Admin\BackgroundsController@getActive']);
	});

	# Pages

	Route::group(['prefix' 	 => 'pages'], function(){
		Route::get('/', [
			'as' => 'page.index',
			'uses' => 'Controllers\Admin\PagesController@getIndex'
		]);

		Route::get('edit/{id?}', [
			'as' => 'page.edit',
			'uses' => 'Controllers\Admin\PagesController@getEdit'
		]);

		Route::post('edit/{id?}',  'Controllers\Admin\PagesController@getEdit');

		Route::get('active/{id}', [
			'as' 	=> 'page.active',
			'uses' 	=> 'Controllers\Admin\PagesController@getActive'
		]);

		Route::get('delete/{id}', [
			'as' => 'page.delete',
			'uses' => 'Controllers\Admin\PagesController@getDelete'
		]);
	});

    Route::post('/upload/images', ['as' => 'upload.images', 'uses' => 'Controllers\Admin\PostsController@uploadImage']);

	// Posts
	Route::group(['prefix' 	 => 'posts'], function() {
		Route::get('/', [
			'as' => 'post.index',
			'uses' => 'Controllers\Admin\PostsController@getIndex'
		]);

		Route::get('edit/{id?}', [
			'as' => 'post.edit',
			'uses' => 'Controllers\Admin\PostsController@getEdit'
		]);

		Route::post('edit/{id?}',  'Controllers\Admin\PostsController@getEdit');

		Route::get('delete/{id}', [
			'as' => 'post.delete',
			'uses' => 'Controllers\Admin\PostsController@getDelete'
		]);

		Route::get('active/{id}', [
			'as' 	=> 'post.active',
			'uses' 	=> 'Controllers\Admin\PostsController@getActive'
		]);

		Route::get('hot/{id}', [
			'as' 	=> 'post.hot',
			'uses' 	=> 'Controllers\Admin\PostsController@getHot'
		]);
	});

	// Quản lý feedbacks
	Route::group(['prefix' => 'feedbacks'], function() {
		Route::get('/', [
			'as' => 'feedback.index',
			'uses' => 'Controllers\Admin\FeedbackController@getIndex'
		]);
	});

	// Quản lý subscribers
	Route::group(['prefix' => 'subscribers'], function() {
		Route::get('/', [
			'as' => 'subscriber.index',
			'uses' => 'Controllers\Admin\SubscriberController@getIndex'
		]);
	});

	// Testimonials
	Route::group(['prefix' 	 => 'testimonials'], function() {
		Route::get('/', [
			'as' => 'testimonial.index',
			'uses' => 'Controllers\Admin\TestimonialController@getIndex'
		]);

		Route::get('edit/{id?}', [
			'as' => 'testimonial.edit',
			'uses' => 'Controllers\Admin\TestimonialController@getEdit'
		]);

		Route::post('edit/{id?}',  'Controllers\Admin\TestimonialController@getEdit');

		Route::get('delete/{id}', [
			'as' => 'testimonial.delete',
			'uses' => 'Controllers\Admin\TestimonialController@getDelete'
		]);

		Route::get('active/{id}', [
			'as' 	=> 'testimonial.active',
			'uses' 	=> 'Controllers\Admin\TestimonialController@getActive'
		]);
	});

	// Bookings

	Route::group(['prefix' => 'bookings'], function() {
		Route::get('/', [
			'as'   => 'booking.admin.index',
			'uses' => 'Controllers\Admin\BookingController@getIndex'
		]);
		Route::get('/{bookingId}/change-status', [
		   'as'     => 'booking.account.change.status',
			'uses'   => 'Controllers\Admin\BookingController@changeStatus'
		]);
	});

	Route::group(['prefix' => 'auto-module'], function() {
		Route::get('/create', 'Controllers\Admin\AutoModuleController@getCreate');
		Route::post('/create', 'Controllers\Admin\AutoModuleController@postCreate');
		Route::post('/create/step-2', 'Controllers\Admin\AutoModuleController@postCreateStep2');
	});

	// Banner
	Route::group(['prefix' 	 => 'banner'], function(){
		Route::get('/', ['as'       => 'banner', 'uses' => 'Controllers\Admin\BannerController@getIndex']);
		Route::get('edit/{id}', ['as'    => 'edit-banner', 'uses' 	=> 'Controllers\Admin\BannerController@getEdit']);
		Route::post('edit/{id}', ['as'   => 'post-update-banner', 'uses' 	=> 'Controllers\Admin\BannerController@postUpdate']);
		Route::get('delete/{id}', ['as'  => 'delete-banner', 'uses' => 'Controllers\Admin\BannerController@getDelete']);
		Route::get('active/{id}', ['as'  => 'active-banner', 'uses' => 'Controllers\Admin\BannerController@getActive']);
	});

	// Places
	Route::group(['prefix' => 'places', 'namespace' => 'Controllers\Admin'], function() {
		Route::get('/', [
			'as'		=>	'place.index',
			'uses' 	=> 'PlaceController@getIndex'
		]);

		Route::get('/create', [
			'as'		=>	'place.create',
			'uses'	=>	'PlaceController@getCreate'
		]);

		Route::post('/create', [
			'as'		=>	'post.place.create',
			'uses'	=>	'PlaceController@postCreate'
		]);

		Route::get('/edit/{id}', [
			'as'		=>	'place.edit',
			'uses'	=>	'PlaceController@getEdit'
		]);

		Route::post('/edit/{id}', [
			'as'		=>	'post.place.edit',
			'uses'	=>	'PlaceController@postEdit'
		]);

		Route::get('delete/{id}', [
			'as' 		=> 'place.delete',
			'uses' 	=> 'PlaceController@getDelete'
		]);

		Route::get('active/{id}', [
			'as' 		=> 'place.active',
			'uses' 	=> 'PlaceController@getActive'
		]);
	});

	// Cities
	Route::group(['prefix' => 'cities', 'namespace' => 'Controllers\Admin'], function() {
		Route::get('/', [
			'as'     => 'cities.index',
			'uses'   => 'CityController@getIndex'
		]);

		Route::get('/edit/{id?}', [
			'as'     => 'cities.edit',
			'uses'   => 'CityController@getEdit'
		]);

		Route::post('/edit/{id?}', [
			'as'     => 'post.cities.edit',
			'uses'   => 'CityController@getEdit'
		]);

		Route::get('delete/{id}', [
			'as'     => 'cities.delete',
			'uses'   => 'CityController@getDelete'
		]);

		Route::get('active/{id}', [
			'as'     => 'cities.active',
			'uses'   => 'CityController@getActive'
		]);

		Route::get('hot/{id}', [
			'as'     => 'cities.hot',
			'uses'   => 'CityController@getHot'
		]);

	});

	// Loai địa danh
	Route::group(['prefix' => 'cplaces', 'namespace' => 'Controllers\Admin'], function() {
		Route::get('/', [
			'as'		=>	'cplace.index',
			'uses' 	=> 'CatPlaceController@getIndex'
		]);

		Route::get('edit/{id?}', [
			'as' => 'cplace.edit',
			'uses' => 'CatPlaceController@getEdit'
		]);

		Route::post('edit/{id?}',  'CatPlaceController@getEdit');

		Route::get('delete/{id}', [
			'as' 		=> 'cplace.delete',
			'uses' 	=> 'CatPlaceController@getDelete'
		]);

		Route::get('active/{id}', [
			'as' 		=> 'cplace.active',
			'uses' 	=> 'CatPlaceController@getActive'
		]);
	});

	// Loai địa danh
	Route::group(['prefix' => 'countries', 'namespace' => 'Controllers\Admin'], function() {
		Route::get('/', [
			'as'		=>	'country.index',
			'uses' 	=> 'CountryController@getIndex'
		]);

		Route::get('edit/{id?}', [
			'as' => 'country.edit',
			'uses' => 'CountryController@getEdit'
		]);

		Route::post('edit/{id?}',  'CountryController@getEdit');

		Route::get('delete/{id}', [
			'as' 		=> 'country.delete',
			'uses' 	=> 'CountryController@getDelete'
		]);

		Route::get('active/{id}', [
			'as' 		=> 'country.active',
			'uses' 	=> 'CountryController@getActive'
		]);
	});

	// Tours
	Route::group(['prefix' => 'tours', 'namespace' => 'Controllers\Admin'], function() {
		Route::get('/', ['as' => 'tours.index', 'uses' => 'TourController@getIndex']);
		Route::get('/unconfirm', ['as' => 'tours.unconfirm', 'uses' => 'TourController@getTourUnConfirm']);
		Route::get('/delete/{id}', ['as' => 'tours.delete', 'uses' => 'TourController@getDelete']);
		Route::get('edit/{id}', ['as' => 'tours.edit', 'uses' => 'TourController@getEdit']);
		Route::post('edit/{id}', ['as' => 'tours.edit.post', 'uses' => 'TourController@postEdit']);
		Route::get('active/{id}', [ 'as' => 'tours.active', 'uses'  => 'TourController@getActive']);
		Route::get('confirm/{id}', [ 'as' => 'tours.confirm', 'uses'   => 'TourController@getConfirm']);
		Route::get('hot/{id}', [ 'as' => 'tours.hot', 'uses' 	=> 'TourController@getHot']);
	});

	# Dashboard
	Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Controllers\Admin\DashboardController@getDashboard']);
	Route::get('/', ['as' => 'admin', 'uses' => 'Controllers\Admin\DashboardController@getIndex']);
});
