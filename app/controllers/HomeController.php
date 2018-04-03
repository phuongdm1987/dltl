<?php
use Fsd\Cities\City;
use Fsd\Cities\CityRepository;
use Fsd\Countries\Country;
use Fsd\Countries\CountryRepository;
use Fsd\Places\Place;
use Fsd\Places\PlaceRepository;
use Fsd\Posts\PostRepository;
use Fsd\Tours\Tour;
use Fsd\Tours\TourRepository;

class HomeController extends BaseController {

	public function __construct(TourRepository $tour, PlaceRepository $place, CityRepository $city, CountryRepository $country, PostRepository $post) {
      $this->tour    = $tour;
      $this->place   = $place;
      $this->city    = $city;
      $this->country = $country;
      $this->post = $post;
		parent::__construct();
	}

   public function getRedirect() {
      return Redirect::to('tour');
   }

	public function getIndex() {

      //Meta data
      $this->metadata->setTitle($this->metadata->getTitle() . ' - Tour du lịch - Vé máy bay - Thuê xe du lịch - Nhà hàng- Khách sạn');
      $this->metadata->setDescription($this->metadata->getDescription() . ' dulichthanglong.vn cung cấp thông tin và giá cả về dịch vụ tour du lịch, thuê xe du lịch, vé máy bay, nhà hàng và khách sạn.
         Danh sách tour du lịch với mức giá rẻ nhất chất lượng do các công ty du lịch uy tín nhất cung cấp.');

      $tourInlandHot      = $this->tour->getTourInlandHot();
      $tourForeignHot     = $this->tour->getTourForeignHot();
      $tourInlandProgram  = $this->tour->getTourInlandProgram();
      $tourForeignProgram = $this->tour->getTourForeignProgram();
      $carHot             = $this->post->getCarHot();
      $hotelHot           = $this->post->getHotelHot();

      // $cities  = $this->city->buildArrayFromListCities($this->cities);
      // $countries  = $this->country->buildArrayFromListCountries($this->countries);

      $compact = ['tourInlandHot', 'tourForeignHot', 'tourInlandProgram', 'tourForeignProgram', 'carHot', 'hotelHot'];

		return View::make('dltl.frontend.home', compact($compact));
	}

   /*==================== them de test ====================*/
   public function getTour()
   {
      //Meta data
      $this->metadata->setTitle($this->metadata->getTitle() . ' - Tour du lịch - Vé máy bay - Thuê xe du lịch - Nhà hàng- Khách sạn');
      $this->metadata->setDescription($this->metadata->getDescription() . ' dulichthanglong.vn cung cấp thông tin và giá cả về dịch vụ tour du lịch, thuê xe du lịch, vé máy bay, nhà hàng và khách sạn.
         Danh sách tour du lịch với mức giá rẻ nhất chất lượng do các công ty du lịch uy tín nhất cung cấp.');

      $cityHotInLand       = $this->city->getCityHotInLand(8);
      $countriesHotForeign = $this->country->getCountriesHotForeign(8);
      // dump_data($countriesHotForeign);
      /*$placesHotInLand     = $this->place->getPlacesHotInLand();
      $placesHotInForeign  = $this->place->getPlacesHotForeign();*/
      $cities  = $this->city->buildArrayFromListCities($this->cities);

      $countries  = $this->country->buildArrayFromListCountries($this->countries);

      return View::make('frontend.home.index', compact('cityHotInLand', 'countriesHotForeign', 'cities', 'countries'));
   }

   public function getList()
   {
      return View::make('frontend.home.list');
   }

}