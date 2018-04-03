<?php namespace Fsd\Places;

use Fsd\Places\Place;

interface PlaceRepository {
	public function getAllPlace();
	public function getAllPlaceActive();
	public function getPlaceByPagination(array $params, $count = 25);
	public function getPlacesHotInland($limit = 12, $status = Place::PUBLISHED);
	public function getPlacesHotForeign($limit = 12, $status = Place::PUBLISHED);
	public function getPlaceById($id);
	public function getFirstPlaceById($id);
	public function getPlaceByCityId($cit_id = 0);
	public function getCityHasPlace();
	public function saveImages(Place $place, array $data);
	public function searchPlace($query);
}
