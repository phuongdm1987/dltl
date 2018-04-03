<?php

class BaseController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;

	/**
	 * Metadata
	 */
	protected $metadata;

	protected $layout;

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{

		// Metadata
		//
		$this->metadata = App::make('metadata');

		View::share('setting', $this->metadata);

		// CSRF Protection
		$this->beforeFilter('csrf', array('on' => 'post'));

		//
		$this->messageBag = new Illuminate\Support\MessageBag;

		$this->cart = new Cart(Input::get('iCity', 1));

		$this->follow = App::make('follow');

		// Login
		$this->login = App::make('login');

		// Page Global
		$pageGlobal     = App::make('Fsd\Pages\PageRepository');
		$categoriesRepo = App::make('Fsd\Categories\CategoryRepository');
		$cityRepo       = App::make('Fsd\Cities\CityRepository');
		$countryRepo    = App::make('Fsd\Countries\CountryRepository');
		$tourRepo       = App::make('Fsd\Tours\TourRepository');

		$categories     = $categoriesRepo->getListChilds();
		$cities         = $cityRepo->getListCities();
		$countries      = $countryRepo->getListCountries();
		$tourRandom     = $tourRepo->getTourRandom();
		$tourByWeek	    = $tourRepo->getTypeByWeek();

		// Cities
		$this->cities = $cities;

      // Countries
      $this->countries = $countries;

		// Global variables in all view
		View::share('GLB_Login', $this->login);
		View::share('GLB_Cart', $this->cart);
		View::share('GLB_Categories', $categories);
		View::share('GLB_Page', $pageGlobal);
		View::share('GLB_Cities', $cities);
		View::share('GLB_Tours', $tourRandom);
		View::share('GLB_ByWeek', $tourByWeek);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	/**
	 * Fill child view và content vào master view
	 * @param $path
	 * @param array $data
	 */
	protected function view($path, $data = [])
	{
		$this->layout->content = View::make($path, $data);
	}


	/**
	 * Redirect to an url with response code
	 * @param $url
	 * @param int $statusCode
	 * @return mixed
	 */
	protected function redirectTo($url, $statusCode = 302)
	{
		return Redirect::to($url, $statusCode);
	}


	/**
	 * Redirect to home page url
	 * @return mixed
	 */
	protected function redirectHome()
	{
		return Redirect::home();
	}



	/**
	 * Redirect to an action
	 * @param $action
	 * @param array $data
	 * @return mixed
	 */
	protected function redirectAction($action, $data = [])
	{
		return Redirect::action($action, $data);
	}



	/**
	 * Redirect to a router
	 * @param $route
	 * @param array $data
	 * @return mixed
	 */
	protected function redirectRoute($route, $data = [])
	{
		return Redirect::route($route, $data);
	}



	/**
	 * Redirect back
	 * @param array $data
	 * @param array $input
	 * @return mixed
	 */
	protected function redirectBack($data = [], $input = [])
	{
		return Redirect::back()->withInput($input)->with($data);
	}



	/**
	 * Redirect tới 1 url đã visit trước đó.
	 * @param null $default
	 * @return mixed
	 */
	protected function redirectIntended($default = null)
	{
		$intended = Session::get('auth.intended_redirect_url');
		if ($intended) {
			return $this->redirectTo($intended);
		}
		return Redirect::to($default);
	}
}
