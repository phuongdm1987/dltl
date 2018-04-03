<?php namespace Fsd\Cities;

use Fsd\Core\EloquentRepository;

class DbCityRepository extends EloquentRepository implements CityRepository {

	public function __construct(City $model) {
		$this->model = $model;
	}

    public function getAll() {
        return $this->model->where('cit_parent', 0)
                            ->get();
    }

	public function getDistrictsByCityId($id) {
		return $this->model->select('cit_id', 'cit_name')
								->where('cit_parent', $id)
								->where('cit_active', City::ACTIVE)
								->orderBy('cit_id', 'ASC')
								->get();
	}

	public function getAllCity() {
		$temp_cities	=	$this->model->where('cit_parent', 0)
												->where('cit_active', City::ACTIVE)
												->orderBy('cit_name', 'ASC')
												->get();
		$cities = array();

		foreach($temp_cities as $city) {
			$cities[$city['cit_id']] = $city['cit_name'];
		}

		return $cities;
	}

   public function getCityByPagination(array $params, $count = 25) {
      $q = array_get($params, 'q');
      $query = $this->model
               ->leftJoin('countries', 'cit_country_id', '=', 'cou_id')
               ->where('cit_parent', '=', 0)
               ->orderBy('cit_name', 'ASC');
      if ($q != "") {
         $query->where('cit_name', 'LIKE', '%'. $q .'%');
      }
      return $query->paginate($count);
   }

   public function getCityById($id) {
      return $this->model->find($id);
   }

   public function getCityHotInLand($limit = 12) {
      $city = $this->model
                    ->join('places', 'pla_city_id', '=', 'cit_id')
                    ->join('tour_places', 'pla_id', '=', 'place_id')
                    ->join('tours', 'tour_id', '=', 'tou_id')
                    ->where('cit_parent', City::INBOUND)
                    ->where('cit_active', City::ACTIVE)
                    ->where('cit_hot', City::HOT)
                    ->groupBy('cit_id')
                    ->take($limit)
                    ->get();
      return $city;
   }


	public function getListCities() {
		return $this->model->where('cit_parent', 0)
                        ->where('cit_active', City::ACTIVE)
								->where('cit_country_id', 1)
                        ->orderBy('cit_hot', 'DESC')
								->orderBy('cit_name', 'ASC')
								->get();
	}


	public function buildArrayFromListCities($cities) {
		$c = [];

		foreach($cities as $city) {
			$c[$city->cit_id] = $city->cit_name;
		}

		return $c;
	}
}