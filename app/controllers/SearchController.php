<?php
use Fsd\Tours\Tour;
use Fsd\Tours\TourRepository;

use Fsd\Places\Place;
use Fsd\Places\PlaceRepository;

use Fsd\Cities\CityRepository;

class SearchController extends BaseController {

	public function __construct(TourRepository $tour, PlaceRepository $place, CityRepository $city) {
		$this->tour  = $tour;
		$this->place = $place;
		$this->city  = $city;
		parent::__construct();
	}

	public function getIndex() {
		$q          		= Xss::clean(Input::get('q'));
		$startCity  		= (int) Input::get('tou_start_city');
		$timeFrom   		= Xss::clean(Input::get('timefrom'));
		$timeTo     		= Xss::clean(Input::get('timeto'));
		$departure     		= (int) Input::get('departure');
		$type     			= (int) Input::get('type');
		$rangePrice 		= (int) Input::get('range_price');

		Session::put('tour_type', $type);

		$this->metadata->setTitle('Kết quả tìm kiếm tour du lịch với từ khóa: ' . $q);
		$this->metadata->setDescription('Tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam');

		$params = [
			'q'                 => $q,
			'start_city'        => $startCity,
		];

		if ($departure) {
			$params['departure'] = $departure;
		}

		if ($type) {
			$params['type'] = $type;
		}

		if($timeFrom) {
			$params['time_from'] = convertDateToTime($timeFrom);
		}

		if($timeTo) {
			$params['time_to'] = convertDateToTime($timeTo);
		}

		if($rangePrice == 1) {
			$params['price_from'] = 0;
			$params['price_to']   = 2000000;
		}
		else if($rangePrice == 2) {
			$params['price_from'] = 2000000;
			$params['price_to']   = 4000000;
		}
		else if($rangePrice == 3) {
			$params['price_from'] = 4000000;
			$params['price_to']   = 6000000;
		}
		else if($rangePrice == 4) {
			$params['price_from'] = 6000000;
			$params['price_to']   = 8000000;
		}
		else if($rangePrice == 5) {
			$params['price_from'] = 8000000;
			$params['price_to'] = 10000000;
		}
		else if($rangePrice == 6) {
			$params['price_from'] = 10000000;
		}

      $sort = $params['sort'] = Input::get('sort', 0);

		$tours = $this->tour->searchToursByParams($params, 10);

		$cities = $this->city->buildArrayFromListCities($this->cities);

		return View::make('frontend/search/index', compact('tours', 'q', 'cities', 'startCity',
		   'rangePrice', 'timeFrom', 'timeTo', 'sort'));
	}
}