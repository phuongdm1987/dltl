<?php namespace Controllers\Api;

use Fsd\Places\PlaceRepository;
use BaseController;
use Response, Input;

class PlaceController extends BaseController {

	public function __construct(PlaceRepository $place) {
		parent::__construct();
		$this->place = $place;
	}

	public function getPlaceByCityId($id = 0) {
		return $this->place->getPlaceByCityId($id);
	}
}