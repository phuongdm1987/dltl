<?php namespace Fsd\Countries;

use Fsd\Core\EloquentRepository;

class DbCountryRepository extends EloquentRepository implements CountryRepository {

	public function __construct(Country $model) {
		$this->model = $model;
	}

	public function getAllCountry() {
		return $this->model->get();
	}

	public function getContryById($id) {
		return $this->model->find($id);
	}

	public function getCountryByPagination($count = 25) {
		return $this->model->paginate($count);
	}

   public function getListCountries() {
      return $this->model->where('cou_active', Country::ACTIVE)
                        ->orderBy('cou_hot', 'DESC')
                        ->orderBy('cou_name', 'ASC')
                        ->get();
   }

   public function getCountriesHotForeign($limit = 12) {
      $country = $this->model
                    ->join('tours', 'cou_id', '=', 'tou_country_destination')
                    ->where('cou_active', Country::ACTIVE)
                    ->where('cou_hot', Country::HOT)
                    ->where('cou_id', '<>', 1)
                    ->groupBy('cou_id')
                    ->take($limit)
                    ->get();
      return $country;
   }

   public function buildArrayFromListCountries($countries) {
      $c = [];

      foreach($countries as $country) {
         $c[$country->cou_id] = $country->cou_name;
      }

      return $c;
   }
}