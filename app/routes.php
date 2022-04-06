<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
require $app['path.base'] . '/app/routes_admin.php';


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/
require $app['path.base'] . '/app/routes_auth.php';


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);
Route::get('/tour', ['as' => 'home-active', 'uses' => 'HomeController@getTour']);
Route::post('/admin/upload/images', ['as' => 'upload.images', 'uses' => 'ImageController@upload']);

// Pages
//
Route::group([ 'prefix' => 'page'], function() {
	Route::get('/{id}-{title}', [
		'as' => 'page.view',
		'uses' => 'PageController@getPageDetail'
	]);
});

//post
Route::group([ 'prefix' => 'post'], function() {
   Route::get('/{id}-{title}', [
      'as' => 'post.detail',
      'uses' => 'PostController@getPostDetail'
   ]);
   Route::get('/list/{id}-{title}', [
      'as' => 'post.list',
      'uses' => 'PostController@getPostByCategory'
   ]);
    Route::get('/lists', [
        'as' => 'post.listAll',
        'uses' => 'PostController@getAll'
    ]);
});

Route::get('/lien-he.html', [
	'as' 		=> 'page/contact',
	'uses' 	=> 'ContactUsController@getIndex'
]);

Route::post('/lien-he.html', [
	'as' => 'contact.post',
	'uses' => 'ContactUsController@postIndex'
]);

// Subscriber register
//
Route::post('/subscribe', [
	'as' => 'subscribe',
	'uses' => 'SubscriberController@postSubscriber'
]);


// Subscriber unregister
//
Route::get('/unsubscribe', [
	'as' => 'unsubscribe',
	'uses' => 'SubscriberController@getUnSubscriber'
]);


Route::group(['prefix' => 'api', 'namespace' => 'Controllers\Api'], function() {
	// Category
	Route::group(['prefix' => 'category'], function() {
		Route::get('/', 'CategoryController@getAllCategories');
		Route::get('/get-level-0', ['as' => 'api.category.getLevel0', 'uses' => 'CategoryController@getCategoriesLevel0']);
		Route::get('/getAllChilds', ['as' => 'api.category.getAllChilds', 'uses' => 'CategoryController@getAllChilds']);
		Route::get('/{id}', ['as' => 'api.category.getById', 'uses' => 'CategoryController@getById']);
	});

	// Cities
	Route::group(['prefix' => 'city'], function() {
		Route::get('/', ['as' => 'city.all', 'uses' => 'CityController@getAllCity']);
		Route::get('{id}', ['as' => 'getDistricts', 'uses' => 'CityController@getDistrictsByCityId']);
	});

	// Places
	Route::group(['prefix' => 'place'], function() {
		Route::get('{id}', [
			'as' => 'getPlaceByCityId',
			'uses' => 'PlaceController@getPlaceByCityId'
		]);
	});

	// Tags
	Route::group(['prefix' => 'tags'], function() {
		Route::get('/tags.json', [
			'as'		=> 'suggest_tag',
			'uses'	=> 'TagController@getSuggestTag'
		]);

		Route::get('/places.json', [
			'as'		=> 'suggest_place',
			'uses'	=> 'TagController@getSuggestPlace'
		]);
	});

    // update resize image
    Route::get('/update-image', ['as' => 'update-image', 'uses' => 'UpdateResizeImageController@updateResizeImage']);
});


Route::get('/test', 'TestController@index');
Route::get('/list', 'HomeController@getList');

Route::get('/me/tours', 'HomeController@getTours');

Route::get('/p{placeId}/tour-du-lich-{placeSlug}', ['as' => 'place.list', 'uses' => 'PlaceController@getIndex']);

Route::get('/tim-kiem', ['as' => 'search', 'uses' => 'SearchController@getIndex']);

// Route::get('/t{tourID}/{tourSlug}.html', ['as' => 'tour.detail', 'uses' => 'TourController@getIndex']);

Route::group(['prefix' => 'booking'], function() {
	Route::get('/', ['as' => 'tour.booking', 'uses' => 'BookingController@getBooking']);
	Route::post('/', ['as' => 'tour.booking.create', 'uses' => 'BookingController@createBooking']);
	Route::get('/{id}-{code}-dat-tour-thanh-cong.html', ['as' => 'booking.success', 'uses' => 'BookingController@getUrlSuccess']);
});

/*
* Frontend
*/
Route::group(['prefix' => 'tour'], function() {

	Route::get('/p{id}/tour-du-lich-{pla_slug}', [
		'as' => 'tour.by.place',
		'uses' => 'TourController@getTourByPlace'
	]);

   Route::get('/c{id}/tour-du-lich-{cit_slug}', [
      'as' => 'tour.by.city',
      'uses' => 'TourController@getTourByCity'
   ]);

   Route::get('/n{id}/tour-du-lich-{cou_slug}', [
      'as' => 'tour.by.country',
      'uses' => 'TourController@getTourByCountry'
   ]);

   Route::get('/type/{id}/{cou_slug}', [
      'as' => 'tour.by.type',
      'uses' => 'TourController@getTourByType'
   ]);

	Route::get('/t{id}/{name}', [
		'as' => 'tour.detail',
		'uses' => 'TourController@getDetailTour'
	]);

	Route::get('/{id}-{name}.html', [
		'as' 		=> 'tour.by.user',
		'uses' 	=> 'TourController@getTourByUser'
  ]);
});
