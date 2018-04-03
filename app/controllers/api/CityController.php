<?php namespace Controllers\Api;

use Fsd\Cities\CityRepository;
use BaseController;
use Response;
class CityController extends BaseController {

	public function __construct(CityRepository $city)
	{
		parent::__construct();
		$this->city = $city;
	}


	/**
	 * Lấy tất cả quận/huyện theo tình/thành phố
	 *
	 * @param  integer $cityId
	 * @return json
	 */
	public function getDistrictsByCityId($cityId) {
		return $this->city->getDistrictsByCityId($cityId);
	}


	/**
	 * Tất cả thành phố
	 *
	 * @return json
	 */
	public function getAllCity()	{
		return $this->city->getAllCity();
	}


	/**
	 *  Lấy thông tin thành phố, quận/huyện
	 *
	 * @param  integer $id
	 * @return json
	 */
	public function getById($id)
	{
		$this->city->find($id);
	}
}