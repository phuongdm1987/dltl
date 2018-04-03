<?php namespace Fsd\CategoryPlaces;

use Fsd\CategoryPlaces\CatPlace;

interface CatPlaceRepository {
	public function getAllCatPlace();
	public function getCatPlaceById($id);
	public function getCatPlaceByPagination($count = 25);
}