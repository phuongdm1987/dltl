<?php namespace Fsd\Tours;

use Fsd\Core\EloquentRepository;
use Fsd\Users\User;
use Fsd\Tags\Tag;
use Fsd\Tags\TagRepository;
use Fsd\Places\PlaceRepository;
use Fsd\Places\Place;
use Fsd\Cities\CityRepository;
use Helper;

use Illuminate\Database\DatabaseManager as DBM;

class DbTourRepository extends EloquentRepository implements TourRepository
{

	public function __construct(DBM $db, Tour $model, TagRepository $tagRepo, PlaceRepository $plaRepo, CityRepository $city) {
		$this->model   = $model;
		$this->db      = $db;
		$this->tagRepo = $tagRepo;
		$this->plaRepo = $plaRepo;
		$this->city    = $city;
	}

    public function getAll()
    {
        return $this->model->get();
    }

	/*
	* Dữ liệu lấy ra sử dụng trong admin
	*/
	public function getToursByPaginated(array $params, $count = 25, $confirm = Tour::STATUS_CONFIRM) {
		$q             = array_get($params, 'q');
		$cityDeparture = array_get($params, 'cityDeparture');
		$query         = $this->model->where('tou_confirm', $confirm)
			->orderBy('tou_created_time', 'DESC');

		$query->where(function($where) use($q) {
			if($q) {
				$where->where('tou_name', 'LIKE', '%'. $q .'%');
				$where->orWhere('tou_price', 'LIKE', '%'. $q .'%');
				$where->orWhere('tou_id', '=', $q);
			}
		});

		$query->where(function($q) use($cityDeparture) {
			if($cityDeparture) {
				$q->where('tou_city_departure', $cityDeparture);
			}
		});

		dd($query->toSql());
		return $query->paginate($count);
	}

	public function getTourById($id) {
		return $this->model->find($id);
	}

	 public function getPublishToursPaginated($count = 10) {
		$query =  $this->model->where('tou_status', Tour::STATUS_ACTIVE);

        if ($count > 0 ) {
            return $query->paginate($count);
        }

        return $query->get();
	 }

	 public function getPublishToursByTypePaginated($type, $count = 10) {
		return $this->model->where('tou_type', $type)->paginate($count);
	 }


	 public function getToursPaginatedByUser(User $user, $count = 10, $where = null, $sort = null) {
			return $this->model->where('tou_user_id', $user->id)
									->where($where)
									->paginate($count);
	 }

	 public function getToursByDestinationPaginated(Place $place, $count = 10) {
			return $this->model->join('places', 'tou_departure', '=', 'pla_id')
												 ->where('tou_destination', $place->pla_id)
												 ->where('tou_status', Tour::STATUS_ACTIVE)
												 ->paginate($count);
	 }

	 public function getTourByPlace($plaId, $count = 10, array $param = array()) {

		$place = $this->plaRepo->getFirstPlaceById($plaId);

		if ( ! is_null($place)) {
			$tours = $place->tours()->lists('tou_id');
		} else {
			$tours = 0;
		}

		$sort    = array_get($param, 'sort', 0);

		$array_sort_info = $this->getInfoSort($sort);

		$query =  $this->model->join('cities', 'tou_city_departure', '=', 'cit_id');

		if ($sort == 3) {
			$sql_raw = "COUNT(boo_tour_id) AS count_booking";
			$query->select(array('tours.*', \DB::raw($sql_raw)));
			$query->leftJoin('bookings', 'tou_id', '=', 'boo_tour_id');
		}

		$day		= array_get($param, 'day', 0);
		$night	= array_get($param, 'night', 0);

		if ($day) {
			$query->where('tou_day', $day);
		}

		if ($night) {
			$query->where('tou_night', $night);
		}

		$query->where('tou_status', Tour::STATUS_ACTIVE)
				->whereIn('tou_id', $tours)
				->orderBy($array_sort_info['field'], $array_sort_info['orderBy']);

		return $query->paginate($count);
	 }

	 public function getTourByCity($cityId, $count = 10, array $param = array()) {

		$sort            = array_get($param, 'sort', 0);
		$district        = array_get($param, 'district', 0);
		$array_sort_info = $this->getInfoSort($sort);

		$query = $this->model->join('tour_places', 'tou_id', '=', 'tour_id')
									->join('places', 'place_id', '=', 'pla_id')
									->join('cities', 'pla_city_id', '=', 'cit_id');

		if ($sort == 3) {
			$sql_raw = "COUNT(boo_tour_id) AS count_booking";
			$query->select(array('tours.*', \DB::raw($sql_raw)));
			$query->leftJoin('bookings', 'tou_id', '=', 'boo_tour_id');
		}

		$day		= array_get($param, 'day', 0);
		$night	= array_get($param, 'night', 0);

		if ($day) {
			$query->where('tou_day', $day);
		}

		if ($night) {
			$query->where('tou_night', $night);
		}

		$query->where('tou_status', Tour::STATUS_ACTIVE)
				->where('cit_id', $cityId)
				->groupBy('tou_id')
				->orderBy($array_sort_info['field'], $array_sort_info['orderBy']);
		if ($district) {
			$query->where('pla_district_id', $district);
		}

		// $tours =

		return $query->paginate($count);
	 }

	 public function getTourByCountry($countryId, $count = 10, array $param = array()) {

		$sort    = array_get($param, 'sort', 0);

		$array_sort_info = $this->getInfoSort($sort);

		$query = $this->model->join('tour_places', 'tou_id', '=', 'tour_id')
									->join('places', 'place_id', '=', 'pla_id')
									->join('cities', 'pla_city_id', '=', 'cit_id')
									->join('countries', 'cit_country_id', '=', 'cou_id');

		if ($sort == 3) {
			$sql_raw = "COUNT(boo_tour_id) AS count_booking";
			$query->select(array('tours.*', \DB::raw($sql_raw)));
			$query->leftJoin('bookings', 'tou_id', '=', 'boo_tour_id');
		}

		$day		= array_get($param, 'day', 0);
		$night	= array_get($param, 'night', 0);

		if ($day) {
			$query->where('tou_day', $day);
		}

		if ($night) {
			$query->where('tou_night', $night);
		}

		$query->where('cou_id', $countryId)
				->where('tou_status', Tour::STATUS_ACTIVE)
				->groupBy('tou_id')
				->orderBy($array_sort_info['field'], $array_sort_info['orderBy']);
		$tours = $query->paginate($count);

		return $tours;
	 }

	 public function getInfoSort($sort) {
		$array_return = [];
		switch ($sort) {
			case 1:
				$field   = 'tou_price';
				$orderBy = 'ASC';
				break;

			case 2:
				$field   = 'tou_price';
				$orderBy = 'DESC';
				break;

			case 3:
				$field   = 'tou_price';
				$orderBy = 'DESC';
				break;

			case 4:
				$field   = 'tou_price';
				$orderBy = 'DESC';
				break;

			default:
				$field   = 'tou_hot';
				$orderBy = 'DESC';
				break;
		}

		$array_return['field']   = $field;
		$array_return['orderBy'] = $orderBy;

		return $array_return;
	 }

	 public function getContentTourById(Tour $tour) {
		return $this->db->table('tour_contents')
							->where('tco_tour_id', $tour->tou_id)
							->first();
	 }

    public function getContentTourByIds($tourIds) {
        $contents = $this->db->table('tour_contents')
            ->whereIn('tco_tour_id', $tourIds)
            ->get();

        $result = [];
        foreach ($contents as $content) {
            $result[$content->tco_tour_id] = $content;
        }

        return $result;
    }

	 public function getTourByWeek(Tour $tour) {
		return $this->db->table('tours_by_week')
							->where('tbw_tou_id', $tour->tou_id)
							->get();
	 }

	public function saveContent(Tour $tour, array $data) {
		$this->db->table('tour_contents')->where('tco_tour_id', $tour->tou_id)->delete();

		return $this->db->table('tour_contents')->insert([
			'tco_tour_id'        => $tour->tou_id,
			'tco_tour_schedule'  => array_get($data, 'tco_tour_schedule'),
			'tco_tour_policies'  => array_get($data, 'tco_tour_policies'),
			'tco_tour_comprise'  => array_get($data, 'tco_tour_comprise')
		]);
	}

	public function saveImages(Tour $tour, array $data) {
		foreach($data as $key => $image) {
			$this->db->table('tour_images')->insert([
				'tim_tour_id'     => $tour->tou_id,
				'tim_tour_image'  => $image
			]);
		}
	}

	public function removePhotoTour($id = 0) {
		return $this->db->table('tour_images')
							->where('tim_id', $id)
							->delete();
	}

	public function removePhotoByTourId(Tour $tour) {
		return $this->db->table('tour_images')
							->where('tim_tour_id', $tour->tou_id)
							->delete();
	}

	public function removeContentByTourId(Tour $tour) {
		return $this->db->table('tour_contents')
							->where('tco_tour_id', $tour->tou_id)
							->delete();
	}

	 public function searchToursByKeyword($q, $count = 10) {
			return $this->model->join('places', 'tou_departure', '=', 'pla_id')
									->where('tou_name', 'LIKE', '%'. $q .'%')
									->where('tou_status', Tour::STATUS_CONFIRM)
									->orWhere('pla_name', 'LIKE', '%'. $q .'%')
									->paginate($count);
	 }

	 public function searchToursByParams(array $params, $count = 10) {
			$q         = array_get($params, 'q');
			$startCity = array_get($params, 'start_city');
			$timeFrom  = array_get($params, 'time_from');
			$timeTo    = array_get($params, 'time_to');
			$priceFrom = array_get($params, 'price_from');
			$priceTo   = array_get($params, 'price_to');
			$departure   = array_get($params, 'departure');
			$type   = array_get($params, 'type');
			// $placeDestination = (int) array_get($params, 'place_destination');

			$query = $this->model->join('tour_places', 'tou_id', '=', 'tour_id')
										->join('places', 'pla_id', '=', 'place_id')
										->join('cities', 'tou_city_departure', '=', 'cit_id')
										->where('tou_status', Tour::STATUS_CONFIRM)
										->groupBy('tou_id');

			$query->where(function($where) use($q) {
				 $where->where('tou_name', 'LIKE', '%'. $q .'%');
				 $where->orWhere('pla_slug', 'LIKE', '%'. removeTitle($q) .'%');
			});

			$query->where(function($q) use ($startCity, $timeFrom, $timeTo, $priceFrom, $priceTo, $departure, $type) {
				if($startCity) {
					$q->where('tou_city_departure', $startCity);
				}

				if($timeFrom) {
					$q->where('tou_start_time', '>=', $timeFrom);
				}

				if($timeTo) {
					$q->where('tou_end_time', '<=', $timeTo);
				}

				if($priceFrom) {
					$q->where('tou_price', '>=', $priceFrom);
				}

				if($priceTo) {
					$q->where('tou_price', '<=', $priceTo);
				}
				if($departure) {
					$q->where('tou_city_departure', $departure);
				}
				if($type) {
					$q->where('tou_type', $type);
				}
			});
			return $query->paginate($count);

	 }

	public function getTourPaginateByUserId(array $params, $user_id, $count = 25) {
		$q    = array_get($params, 'query');

		$query = $this->model->where('tou_user_id', $user_id)
								->orderBy('tou_created_time', 'DESC');

		$query->where(function($where) use($q) {
			$where->where('tou_name', 'LIKE', '%'. $q .'%');
		});

		return $query->paginate($count);
	}

	public function getAllPhotoByTourId(Tour $tour) {
		return $this->db->table('tour_images')
							->where('tim_tour_id', $tour->tou_id)
							->get();
	}

	public function getTourContent(Tour $tour) {
		return $this->db->table('tour_contents')
								->where('tco_tour_id', $tour->tou_id)
								->first();
	}

	public function getUserInfoTourById(Tour $tour) {
		$user_info = $this->model->join('users', 'tou_user_id', '=', 'id')
								->where('tou_id', $tour->tou_id)
								->first();
		return $user_info;
	}
	/**
	** Tours Create
	**/

	public function savePostTags(Tour $tour, $inputTags) {
		$tags    = explode(',', $inputTags);
		$tag_ids = [];

		foreach ($tags as $t) {
			// Get tag by slug
			$tag = $this->tagRepo->getTagByName($t);

			if (!$tag && $t) {
				$tag        = new Tag;
				$tag->name  = $t;
				$tag->slug  = Helper::removeTitle($t);
				$tag->words = count(explode(' ', $t));
				if ($tag->save()) {
					$tag_ids[] = $tag->id;
				}
			} elseif ($tag) {
				$tag_ids[] = $tag->id;
			}
		}

		// Sync tours tags to pivot table
		if (count($tag_ids) > 0) {
			$tour->taggings()->sync($tag_ids);
		}
	}

	/*
	* Places to tours
	*/
	public function saveTourPlace(Tour $tour, $inputPlaces) {
		$places     = explode(',', $inputPlaces);
		$place_ids  = [];

		foreach ($places as $p) {
			// Get tag by slug
			$place         = $this->plaRepo->getPlaceByName($p);
			if ($place) {
				$place_ids[]   = $place->pla_id;
			}
		}

		// Sync tours tags to pivot table
		if (count($place_ids) > 0) {
			$tour->placeings()->sync($place_ids);
		}
	}

	/*
	* get tour by user
	*/
	public function getTourByUser(User $user, $count = 10, array $param = array()) {

		$sort    = array_get($param, 'sort', 0);

		$array_sort_info = $this->getInfoSort($sort);

		$query = $this->model->join('tour_places', 'tou_id', '=', 'tour_id')
								->join('places', 'place_id', '=', 'pla_id')
								->join('cities', 'tou_city_departure', '=', 'cit_id')
								->where('tou_user_id', $user->id)
								->where('tou_status', Tour::STATUS_ACTIVE)
								->groupBy('tou_id');

		if ($sort == 3) {
			$sql_raw = "COUNT(boo_tour_id) AS count_booking";
			$query->select(array('tours.*', \DB::raw($sql_raw)));
			$query->leftJoin('bookings', 'tou_id', '=', 'boo_tour_id');
		}

		$query->orderBy($array_sort_info['field'], $array_sort_info['orderBy']);
		$tours = $query->paginate($count);

		return $tours;
	}

	public function updateTourDeleteInfo(Tour $tour)
	{
		$tour->tou_user_id = 3;
		return $tour->save();
	}

	public function getTourRandom($count = 5) {
		return $this->model->where('tou_hot', 1)->orderByRaw("RAND()")->take($count)->get();
	}

	public function getTypeByWeek() {
		return [
			1 => 'Thứ 2',
			2 => 'Thứ 3',
			3 => 'Thứ 4',
			4 => 'Thứ 5',
			5 => 'Thứ 6',
			6 => 'Thứ 7',
			7 => 'Chủ Nhật'
		];
	}

    public function getHotTours($count = 5) {
        return $this->model
            ->where('tou_hot', 1)
            ->where('tou_confirm', 1)
            ->orderBy('tou_updated_time', 'DESC')
            ->take($count)->get();
    }

	public function getTourHotNew(Tour $tour, $count = 20) {
		return $this->model->where('tou_type', $tour->tou_type)
            ->where('tou_hot', 1)
            ->where('tou_confirm', 1)
            ->orderBy('tou_updated_time', 'DESC')
            ->take($count)->get();
	}

	public function getTourInlandHot($count = 7)
	{
		return $this->model
			->where('tou_type', Tour::TYPE_INLAND)
			->where('tou_hot', 1)
			->where('tou_confirm', 1)
			->orderBy('tou_updated_time', 'DESC')
			->take($count)->get();
	}

	public function getTourForeignHot($count = 7)
	{
		return $this->model
			->where('tou_type', Tour::TYPE_FOREIGN)
			->where('tou_hot', 1)
			->where('tou_confirm', 1)
			->orderBy('tou_updated_time', 'DESC')
			->take($count)->get();
	}

	public function getTourInlandProgram($count = 5)
	{
		return $this->model
			->where('tou_type', Tour::TYPE_INLAND)
			->where('tou_hot', 0)
			->where('tou_confirm', 1)
			->orderBy('tou_updated_time', 'DESC')
			->take($count)->get();
	}

	public function getTourForeignProgram($count = 5)
	{
		return $this->model
			->where('tou_type', Tour::TYPE_FOREIGN)
			->where('tou_hot', 0)
			->where('tou_confirm', 1)
			->orderBy('tou_updated_time', 'DESC')
			->take($count)->get();
	}

	/**
	 * Lấy tất cả các tour theo tags
	 */

	public function getTourByTag($tags, $count = 20) {
		$tag = \App::make('Fsd\Tags\Tag')->where('slug', $tags)->first();
		if ( ! is_null($tag)) {
			$tours = $tag->tours()->select('tours.tou_id as tid')->lists('tid');
		} else {
			$tours = 0;
		}
	}
}