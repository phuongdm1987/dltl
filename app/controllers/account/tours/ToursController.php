<?php namespace Controllers\Account;

// Repository
use Fsd\Tours\TourRepository;
use Fsd\Tours\Tour;
use Fsd\Places\PlaceRepository;
use Fsd\Countries\CountryRepository;
use Fsd\Cities\CityRepository;
use Fsd\Tags\TagRepository;
use Fsd\Validators\TourValidator;

use AuthorizedController;
use Libs\UploadService;
use View, Response, Request, Redirect, DataGrid, Input, App, Xss, Image, Config, DB;

class ToursController extends AuthorizedController {

	public function __construct(TourRepository $mTour, PlaceRepository $mPlace,
										CountryRepository $mContry, CityRepository $mCity,
										TagRepository $mTag, UploadService $upload,
										TourValidator $validator) {

		parent::__construct();

		$this->mTour 	= $mTour;
		$this->mPlace 	= $mPlace;
		$this->mContry = $mContry;
		$this->mCity 	= $mCity;
		$this->mTag 	= $mTag;
		$this->upload 	= $upload;
		$this->validator = $validator;
	}

	private function getTypeByWeek() {
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

	public function getIndex() {
		$params = [
			'query' 	=> Xss::clean(Input::get('query'))
		];

		$tours = $this->mTour->getTourPaginateByUserId($params, $this->login->getId(), 20);
		return View::make('/frontend/account/tours/index', compact('tours'));
	}

	public function getEdit($id = 0) {

		if ($id > 0) {
			$tour = $this->mTour->getTourById($id);

			if (!$tour) return Redirect::to(route('account.tour.index'))->with('error', 'Không tìm thấy tài nguyên');

			$content 		= $this->mTour->getContentTourById($tour);
			// Lấy ảnh minh họa
			$photos			= $this->mTour->getAllPhotoByTourId($tour);

			$weeks_db = '';
			if ($tour->tou_by_week != null) {
				$weeks_db = explode(',' , $tour->tou_by_week);
			}

			if ($tour->tou_user_id != $this->login->getId()) return Redirect::to(route('account.tour.index'))->with('error', 'Bạn không có quyền sửa tour này');

		}else {
			$tour = $this->mTour->getInstance();
		}

		if(Request::isMethod('post')) {
			return $this->postEdit($tour);
		}

		/*
		* Lấy dữ liệu liên từ các bảng liên quan
		*/
		$cities 		= $this->mCity->getAllCity();
		$weeks		= $this->getTypeByWeek();
		$countries 	= $this->mContry->getAllCountry();

		if ($id > 0) {
			return View::make('/frontend/account/tours/edit', compact('tour', 'cities', 'weeks', 'countries', 'content', 'photos', 'weeks_db'));
		}else{
			return View::make('/frontend/account/tours/edit', compact('tour', 'cities', 'weeks', 'countries'));
		}
	}

	public function postEdit($tour) {

		if(!$this->validator->validate(Input::all(), false)) {
			return Redirect::back()->withInput()->withErrors($this->validator->getErrors());
		}

		$tour->tou_name                = Xss::clean(Input::get('tou_name'));
		$tour->tou_tags                = Xss::clean(Input::get('tou_tags'));
		$tour->tou_price               = Xss::clean(Input::get('tou_price'));
		$tour->tou_user_id             = $this->login->getId();
		$tour->tou_day                 = (int) Input::get('tou_day');
		$tour->tou_night               = (int) Input::get('tou_night');
		$tour->tou_start_type          = (int) Input::get('tou_start_type');
		$tour->tou_type                = (int) Input::get('tou_type');
		$tour->tou_country_departure   = (int) Input::get('tou_country_departure');
		$tour->tou_city_departure      = (int) Input::get('tou_city_departure');
		$tour->tou_country_destination = (int) Input::get('tou_country_destination');
		$tour->tou_place_destination   = Xss::clean(Input::get('tou_place_destination'));
		$tour->tou_vehicle             = Xss::clean(Input::get('tou_vehicle'));
		$tour->tou_teaser              = Xss::clean(Input::get('tou_teaser'));
		$tour->tou_status              = Tour::STATUS_ACTIVE;
		$tour->tou_created_time        = time();
		$tour->tou_updated_time        = time();
		$tour->tou_confirm             = Tour::STATUS_CONFIRM;

		if($tour->tou_start_type == 2) {
			$data = implode(',', Input::get('tou_by_week'));
			$tour->tou_by_week	= !empty($data) ? $data : null;
		}elseif($tour->tou_start_type == 3){
			$tour->tou_start_time	=	convertDateToTime(Input::get('tou_start_time'));
		}

		// Upload ảnh đại diện
		$resultUpload = $this->upload->uploadImageTour('tou_image', 'resize', false);

		if($resultUpload['status'] > 0) {
			$tour->tou_image = $resultUpload['filename'];
		}

		try {
			if ($tour->save()) {
				// Lưu thông tin tags liên quan đến tour
				$this->mTour->savePostTags($tour, Input::get('tou_tags'));

				// Luu thong tin places
				$this->mTour->saveTourPlace($tour, Input::get('tou_place_destination'));

				// Lưu thông tin vê tour
				$this->mTour->saveContent($tour, [
					'tco_tour_schedule'	=>	Xss::clean(Input::get('tco_tour_schedule')),
					'tco_tour_policies'	=>	Xss::clean(Input::get('tco_tour_policies')),
					'tco_tour_comprise'	=>	Xss::clean(Input::get('tco_tour_comprise'))
				]);

				// Lưu thông tin hình ảnh về tour
				$uploadPhotoTour = $this->upload->uploadImageTour('tim_tour_image', 'resize', true);
				$this->mTour->saveImages($tour, (array) $uploadPhotoTour['file_name']);
			}

			return Redirect::route('account.tour.index')->with('success', 'Cập nhật thông tin tour thành công');

		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Tạo mới không thành công. Vui lòng kiểm tra lại');
		}
	}

	public function getPhotoTour($id = 0) {

		if (!$tour = $this->mTour->getTourById($id)) return Redirect::to(route('account.tour.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$photos =  $this->mTour->getAllPhotoByTourId($tour);

		return View::make('frontend/account/tours/photo', compact('photos', 'tour'));
	}

	public function getDeletePhoto($id = 0) {
		if($this->mTour->removePhotoTour($id)) {
			return Redirect::back()->with('success', 'Xóa ảnh thành công');
		}

		return Redirect::back()->with('error', 'Xóa ảnh không thành công');
	}

	public function getDelete($id = 0) {

		if (!$tour = $this->mTour->getTourById($id)) return Redirect::to(route('account.tour.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		if ($tour->tou_user_id != $this->login->getId())  return Redirect::to(route('account.tour.index'))->with('error', 'Bạn không có quyền xóa tour này');

		/*DB::beginTransaction();
		try {
			$this->mTour->removeContentByTourId($tour);
			$this->mTour->removePhotoByTourId($tour);

			$tour->delete();
			DB::commit();

			return Redirect::route('account.tour.index')->with('success', 'Hoàn thành xóa tour thành công.');
		} catch (Exception $e) {
			DB::rollback();
    		return Redirect::route('account.tour.index')->with('errors', 'Không thể xóa tour.');
		}*/

      if ($this->mTour->updateTourDeleteInfo($tour)) {
         return Redirect::route('account.tour.index')->with('success', 'Hoàn thành xóa tour thành công.');
      } else {
         return Redirect::route('account.tour.index')->with('errors', 'Không thể xóa tour.');
      }

	}
}