<?php namespace Fsd\Places;

use Fsd\Core\EloquentRepository;
use Illuminate\Database\DatabaseManager as DBM;
use Fsd\Tours\Tour;
use DB;

class DbPlaceRepository extends EloquentRepository implements PlaceRepository {

	public function __construct(Place $model, DBM $db) {
		$this->model = $model;
		$this->db    = $db;
	}

	// Lấy tất cả các địa danh
	public function getAllPlace() {
		return $this->model->get();
	}

	public function getAllPlaceActive() {
		$temp_places	=	$this->model->where('pla_active', Place::PUBLISHED)
												->orderBy('pla_created_at', 'ASC')
												->get();
		$places = array();

		foreach($temp_places as $place) {
			$places[$place['pla_id']] = $place['pla_name'];
		}

		return $places;
	}

	public function getPlaceByCityId($cit_id = 0) {
		return $this->model->where('pla_active', Place::PUBLISHED)
								->where('pla_city_id', $cit_id)
								->orderBy('pla_created_at', 'ASC')
								->get();
	}

	public function getCityHasPlace() {
		return $this->model->join('cities', 'cit_id', '=', 'pla_city_id')
								->select('cit_id', 'cit_name', 'cit_parent')
								->orderBy('cit_id', 'ASC')
								->distinct('cit_id')->get();
	}

	public function getPlaceByPagination(array $params, $count= 25) {
      $q           = removeTitle(array_get($params, 'q'));
      $place_image = array_get($params, 'place_image');

      $query = $this->model->join('cities', 'cit_id', '=', 'pla_city_id');

      if ($place_image >= 0) {
         $query->leftJoin('place_images', 'pla_id', '=', 'pim_pla_id');
         if ($place_image == Place::HAS_IMAGE) {
            $query->where('pim_pla_id', '>', 0);
         } else {
            $query->where('pim_pla_id', '=', null);
         }
      }

      $query->orderBy('pla_created_at', 'DESC')
            ->groupBy('pla_id')
            ->select('pla_id', 'pla_name', 'pla_description', 'cit_name', 'cit_id', 'pla_active', 'pla_created_at');
      $query->where(function($where) use($q) {
         $where->where('pla_slug', 'LIKE', '%'. $q .'%');
      });
		return $query->paginate($count);
	}

	public function getPlaceById($id) {
		return $this->model->find($id);
	}

	public function getFirstPlaceById($id) {
		return $this->model->where('pla_id', $id)->first();
	}

	public function getPlacesIdHotInLand($limit) {
		$places = $this->db->table('tours')
		                   ->select(\DB::raw("tou_destination as place, COUNT(tou_destination) as total"))
		                   ->where('tou_type', Tour::TYPE_INLAND)
		                   ->groupBy('tou_destination')
		                   ->take($limit)
		                   ->lists('place');

		return $places;
	}

	public function getPlacesIdHotInForeign($limit) {
		$places = $this->db->table('tours')
		                   ->select(\DB::raw("tou_destination as place, COUNT(tou_destination) as total"))
		                   ->where('tou_type', Tour::TYPE_FOREIGN)
		                   ->groupBy('tou_destination')
		                   ->take($limit)
		                   ->lists('place');

		return $places;
	}

	public function getPlacesHotInLand($limit = 12, $status = Place::PUBLISHED) {
		return $this->model->join('tour_places', 'tour_places.place_id', '=', 'pla_id')
								->select(DB::raw('count( place_id ) AS place_count, pla_id, pla_name, pla_image'))
								->groupBy('place_id')
								->where('pla_active', $status)
		                  ->where('pla_sector', Place::TYPE_INLAND)
		                  ->orderBy('place_count', 'DESC')
		                  ->take($limit)->get();
	}

	public function getPlacesHotForeign($limit = 12, $status = Place::PUBLISHED) {
		return $this->model->join('tour_places', 'tour_places.place_id', '=', 'pla_id')
								->select(DB::raw('count( place_id ) AS place_count, pla_id, pla_name, pla_image'))
								->groupBy('place_id')
								->where('pla_active', $status)
		                  ->where('pla_sector', Place::TYPE_FOREIGN)
		                  ->orderBy('place_count', 'DESC')
		                  ->take($limit)->get();
	}

	// Lưu ảnh địa danh
	public function saveImages(Place $place, array $data) {
		foreach($data as $key => $image) {
			$this->db->table('place_images')->insert([
				'pim_pla_id'	=> $place->pla_id,
				'pim_image'		=> $image
			]);
		}
	}

	public function getImagePlaceById(Place $place) {
		return $this->db->table('place_images')
							->where('pim_pla_id', $place->pla_id)
							->get();
	}

	public function removeImagePlaceById(Place $place) {
		return $this->db->table('place_images')
							->where('pim_pla_id', $place->pla_id)
							->delete();
	}

	/*
	* search place by name
	*/

	public function searchPlace($query) {
		return $this->model->where('pla_slug', 'LIKE', "%$query%")->take(15)->get();
	}

	public function getPlaceByName($name) {

		$place = $this->model->where('pla_name', $name)->first();

		return $place;
	}
}