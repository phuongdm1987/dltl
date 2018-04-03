<?php namespace Fsd\CategoryPlaces;

use Fsd\Core\EloquentRepository;

class DbCatPlaceRepository extends EloquentRepository implements CatPlaceRepository {

	public function __construct(CatPlace $model) {
		$this->model = $model;
	}

	public function getAllCatPlace() {
		return $this->model->get();
	}

	public function getCatPlaceById($id) {
		return $this->model->find($id);
	}

	public function getCatPlaceByPagination($count = 25) {
		return $this->model->paginate($count);
	}
}