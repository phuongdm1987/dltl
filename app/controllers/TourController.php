<?php
use Fsd\Cities\CityRepository;
use Fsd\Countries\CountryRepository;
use Fsd\Places\Place;
use Fsd\Places\PlaceRepository;
use Fsd\Tours\Tour;
use Fsd\Tours\TourRepository;
use Fsd\Users\UserRepository;

class TourController extends BaseController {

	public function __construct(TourRepository $tour, PlaceRepository $place, CityRepository $city, CountryRepository $country, UserRepository $user) {
		$this->tour    = $tour;
		$this->place   = $place;
		$this->city    = $city;
		$this->country = $country;
		$this->user 	= $user;
		parent::__construct();
	}

	/*
	* Danh sach tour theo dia danh
	* @return: array tours
	*/

	public function getTourByPlace($placeId = 0) {

		if (!$place = $this->place->getById($placeId)) {
			return \App::abort(404);
		}

      $country_id = 0;

		$params = [
			'sort'  => Input::get('sort', 0),
			'day'   => Input::get('day', 0),
			'night' => Input::get('night', 0)
		];

		$sort   = Input::get('sort', 0);

		$tours  = $this->tour->getTourByPlace($place->pla_id, 25, $params);

      if ($city = $this->city->getCityById($place->pla_city_id)) {
         $country_id = $city->cit_country_id;
      }

      //Meta data
		$this->metadata->setTitle('Tour du lịch đến địa danh ' . $place->pla_name . ", giá rẻ khuyến mại :: " . $this->metadata->getTitle());
		$this->metadata->setDescription('Tour du lịch đến địa danh' . $place->pla_name . ', tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam.
         Nhiều ưu đãi, khuyến mại với giá rẻ nhất. Chất lượng tốt nhất.');

      $country = $this->country->getContryById($country_id);

      $cities  = $this->city->buildArrayFromListCities($this->cities);

		return View::make('frontend/places/index', compact('tours', 'place', 'cities', 'city', 'country', 'sort'));
	}

	/*
	* Danh sach tour theo country
	* @return array tour by country
	*/
	public function getTourByCountry($countryId = 0) {

		if (!$country = $this->country->getContryById($countryId)) {
			return \App::abort(404);
		}

     $params = [
			'sort'  => Input::get('sort', 0),
			'day'   => Input::get('day', 0),
			'night' => Input::get('night', 0)
		];

		$sort   = Input::get('sort', 0);

		//Meta data
		$this->metadata->setTitle('Tour du lịch đến ' . $country->cou_name . ", giá rẻ khuyến mại :: " . $this->metadata->getTitle());
		$this->metadata->setDescription('Tour du lịch đến' . $country->cou_name . ', tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam.
         Nhiều ưu đãi, khuyến mại với giá rẻ nhất. Chất lượng tốt nhất.');

		$tours   = $this->tour->getTourByCountry($countryId, 25, $params);

		$cities  = $this->city->buildArrayFromListCities($this->cities);

		return View::make('frontend/countries/index', compact('tours', 'country', 'cities', 'sort'));
	}

	/*
	* Danh sach tour theo type
	* @return array tour by type
	*/
	public function getTourByType($type = 0) {

		$type_name = array_key_exists($type, Tour::TYPE) ? Tour::getTypeNames()[$type] : 'Trong nước';

     	$params = [
			'sort'  => Input::get('sort', 0),
			'day'   => Input::get('day', 0),
			'night' => Input::get('night', 0)
		];

		$sort   = Input::get('sort', 0);

		//Meta data
		$this->metadata->setTitle('Tour du lịch ' . $type_name . ", giá rẻ khuyến mại :: " . $this->metadata->getTitle());
		$this->metadata->setDescription('Tour du lịch ' . $type_name . ', tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam.
         Nhiều ưu đãi, khuyến mại với giá rẻ nhất. Chất lượng tốt nhất.');

		$tours  = $this->tour->getPublishToursByTypePaginated($type, 25, $params);

		$cities  = $this->city->buildArrayFromListCities($this->cities);
		return View::make('frontend/type/index', compact('tours', 'country', 'cities', 'sort', 'type_name'));
	}

	/**
	* Danh sach tour theo thanh pho
	**/

	public function getTourByCity($cityId = 0) {

		if (!$city = $this->city->getCityById($cityId)) {
			return \App::abort(404);
		}

		$sort     = Input::get('sort', 0);
		$district = Input::get('district', 0);
      $params = [
			'sort'     => $sort,
			'district' => $district,
			'day'      => Input::get('day', 0),
			'night'    => Input::get('night', 0)
      ];

		$tours   = $this->tour->getTourByCity($cityId, 25, $params);

		$cities  = $this->city->buildArrayFromListCities($this->cities);

      $country = $this->country->getContryById($city->cit_country_id);

      $places = $this->place->getPlaceByCityId($cityId);

      $districts = $this->city->getDistrictsByCityId($city->cit_id);

      $dist = $this->city->getCityById($district);

      //Meta data
		$this->metadata->setTitle('Tour du lịch đến ' . $district != 0 ? $dist->cit_name .', ' : $city->cit_name . ", giá rẻ khuyến mại :: " . $this->metadata->getTitle());
		$this->metadata->setDescription('Tour du lịch đến' . $district != 0 ? $dist->cit_name .', ' : $city->cit_name . ', tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam.
      Nhiều khuyến mại, ưu đãi. Chất lượng tour đảm bảo.');

		return View::make('frontend/cities/index', compact('tours', 'city', 'cities', 'country', 'places', 'sort', 'districts', 'district', 'dist'));
	}


	/**
	* Chi tiet tour
	**/
	public function getDetailTour($tourId = 0) {

		if(! $tour = $this->tour->getTourById($tourId)) return \App::abort(404);

		$this->metadata->setTitle($tour->tou_name . " :: " . $this->metadata->getTitle());
		$this->metadata->setDescription($tour->tou_name . ', tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam');

		$content = $this->tour->getContentTourById($tour);
		$photos  = $this->tour->getAllPhotoByTourId($tour);
		$cities  = $this->city->buildArrayFromListCities($this->cities);
		$user    = $this->user->getUserById($tour->tou_user_id);

      if ($city = $this->city->getCityById($tour->tou_city_departure)) {
         $country_id = $city->cit_country_id;
      }
      $country = $this->country->getContryById($country_id);

		$topTourHotNew = $this->tour->getTourHotNew($tour, 10);

		return View::make('frontend/home/detail', compact('tour', 'content', 'photos', 'cities', 'city', 'country', 'user', 'topTourHotNew'));
	}

	/**
	 * Danh sach tour theo user
	 */

	public function getTourByUser($userId = 0) {

		if (! $user = $this->user->getUserById($userId)) return \App::abort(404);

		$params = [];
      $sort = $params['sort'] = Input::get('sort', 0);

		//Meta data
		$this->metadata->setTitle('Danh sách tour của ' . $user->fullName() .  ' :: ' . $this->metadata->getTitle());
		$this->metadata->setDescription('Danh sách tour của' . $user->fullName() . ', tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam');

		$tours   = $this->tour->getTourByUser($user, 15, $params);

		$cities  = $this->city->buildArrayFromListCities($this->cities);

		return View::make('frontend/users/index', compact('tours', 'cities', 'user', 'sort'));
	}
}
