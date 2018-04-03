<?php namespace Fsd\Cities;

interface CityRepository {
	public function getDistrictsByCityId($id);
   public function getCityByPagination(array $params, $count = 25);
   public function getCityById($id);
   public function getAllCity();
	public function getCityHotInLand($limit);

	public function getListCities();

	public function buildArrayFromListCities($cities);
}