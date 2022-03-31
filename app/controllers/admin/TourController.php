<?php namespace Controllers\Admin;

use AdminController;
use Fsd\Places\PlaceRepository;
use Fsd\Cities\CityRepository;
use Fsd\Countries\CountryRepository;
use Fsd\Tags\TagRepository;
use Fsd\Tours\TourRepository;
use Fsd\Validators\TourValidator;
use Fsd\Tours\Tour;
use Libs\UploadService;
use View, Response, Request, Redirect, DataGrid, Input, App, Xss, DB;

class TourController extends AdminController {

	public function __construct(TourRepository $tour,
										PlaceRepository $place,
										CountryRepository $mContry,
										UploadService $upload,
										TagRepository $mTag,
										TourValidator $validator,
										CityRepository $city) {

		parent::__construct();

		$this->place     = $place;
		$this->city      = $city;
		$this->tour      = $tour;
		$this->mContry   = $mContry;
		$this->upload    = $upload;
		$this->mTag      = $mTag;
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
		$q 				= Xss::clean(Input::get('q'));
      $cityDeparture = (int) Input::get('cityDeparture');
		$params = [
			'q'	=> $q,
			'cityDeparture' => $cityDeparture
		];

		$tours = $this->tour->getToursByPaginated($params, 25);

		$cities 		= $this->city->getAllCity();

		$dataGrid = new DataGrid([
			'data' => $tours,
			'pagination' => [
				'limit_record' => 25,
				'total_record' => $tours->getTotal()
			]
		]);

		$html_option	= '';
		$html				= '';

		foreach($cities as $cit_id => $cit_name) {

			$selected = Input::get("cityDeparture", 0) == $cit_id ? 'selected="selected"' : '';

			$html_option .= '<option value="'. $cit_id .'" '. $selected .'>'. $cit_name .'</option>';
		}

		$html .= '<select class="form-control btn-flat select2" name="cityDeparture">
					<option value="0">-- Điểm khởi hành --</option>
					'. $html_option .'</select>';

      $dataGrid->addSearch(1,1, '', $dataGrid->_formMaker->text(array('name' => 'q', 'value' => Input::get('q'), 'placeholder' => 'Nhập tên tour, giá tour...', 'class' => 'btn-flat')));
      $dataGrid->addSearch(1,2, '', $html);
		$dataGrid->addColumn('tou_id', 'ID', 1);
		$dataGrid->addColumn('tou_name', 'Tên tour', 1, array('width' => 200));
		$dataGrid->addColumn('', 'Hình ảnh', 0, array('width' => 120), function($item){
			return '<div class="tour-image" style="background: url('.$item->getImage().') center center; background-size: cover; width: 100px; height: 100px;"></div>';
		});

		$dataGrid->addColumn('', 'Thông tin tour', 0, array(), function($item){
			return '<table class="table-condensed table-sub table">
							<tr>
								<td>Giá: </td>
								<td>'.format_number($item->tou_price). '<sup>đ</sup></td>
							</tr>
							<tr>
								<td>Thời gian</td>
								<td>'. $item->tou_day . ' ngày - ' . $item->tou_night .' đêm</td>
							</tr>
							<tr>
								<td>Điểm đến</td>
								<td>' .  $item->getPlace() .'</td>
							</tr>
							<tr>
								<td>Phương tiện</td>
								<td>' .  $item->tou_vehicle .'</td>
							</tr>
						</table>';
		});

		$dataGrid->addColumn('tou_teaser', 'Mô tả', 1, array('width' => 200));

		$dataGrid->addColumn('', 'Ngày đăng', 0, array('width' => 100), function($item){
			return date("d/m/Y", $item->tou_created_time);
		});

		$dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['tou_status'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/tours/active/'. $item['tou_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

      $dataGrid->addColumn('', 'Confirm', 0, array('width' => 30), function($item) {
         $classActive = $item['tou_confirm'] == 1 ? 'fa-check-square' : 'fa-square-o';
         return '<a class="btn-action btn-active-action" href="/admin/tours/confirm/'. $item['tou_id'] .'"><i class="fa '. $classActive .'"></i></a>';
      });

      $dataGrid->addColumn('', 'Hot', 0, array('width' => 30), function($item) {
         $classActive = $item['tou_hot'] == 1 ? 'fa-check-square' : 'fa-square-o';
         return '<a class="btn-action btn-active-action" href="/admin/tours/hot/'. $item['tou_id'] .'"><i class="fa '. $classActive .'"></i></a>';
      });

      $dataGrid->addColumn('', 'Sửa', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeEditButton(route('tours.edit', [$item->tou_id]));
		});

		$dataGrid->addColumn('', 'Xóa', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeDeleteButton(route('tours.delete', [$item->tou_id]));
		});

		$data_grid = $dataGrid->render(false);

		return View::make('backend/tours/index', compact('data_grid'));
	}

	public function getTourUnConfirm() {
		$q 				= Xss::clean(Input::get('q'));
      $cityDeparture = (int) Input::get('cityDeparture');
		$params = [
			'q'	=> $q,
			'cityDeparture' => $cityDeparture
		];

		$tours = $this->tour->getToursByPaginated($params, 25, Tour::STATUS_UNCONFIRM);

		$cities 		= $this->city->getAllCity();

		$dataGrid = new DataGrid([
			'data' => $tours,
			'pagination' => [
				'limit_record' => 25,
				'total_record' => $tours->getTotal()
			]
		]);

		$html_option	= '';
		$html				= '';

		foreach($cities as $cit_id => $cit_name) {

			$selected = Input::get("cityDeparture", 0) == $cit_id ? 'selected="selected"' : '';

			$html_option .= '<option value="'. $cit_id .'" '. $selected .'>'. $cit_name .'</option>';
		}

		$html .= '<select class="form-control btn-flat select2" name="cityDeparture">
					<option value="0">-- Điểm khởi hành --</option>
					'. $html_option .'</select>';

      $dataGrid->addSearch(1,1, '', $dataGrid->_formMaker->text(array('name' => 'q', 'value' => Input::get('q'), 'placeholder' => 'Nhập tên tour, giá tour...', 'class' => 'btn-flat')));
      $dataGrid->addSearch(1,2, '', $html);
		$dataGrid->addColumn('tou_id', 'ID', 1);
		$dataGrid->addColumn('tou_name', 'Tên tour', 1, array('width' => 200));
		$dataGrid->addColumn('', 'Hình ảnh', 0, array('width' => 120), function($item){
			return '<div class="tour-image" style="background: url('.$item->getImage().') center center; background-size: cover; width: 100px; height: 100px;"></div>';
		});

		$dataGrid->addColumn('', 'Thông tin tour', 0, array(), function($item){
			return '<table class="table-condensed table-sub table">
							<tr>
								<td>Giá: </td>
								<td>'.format_number($item->tou_price). '<sup>đ</sup></td>
							</tr>
							<tr>
								<td>Thời gian</td>
								<td>'. $item->tou_day . ' ngày - ' . $item->tou_night .' đêm</td>
							</tr>
							<tr>
								<td>Điểm đến</td>
								<td>' .  $item->getPlace() .'</td>
							</tr>
							<tr>
								<td>Phương tiện</td>
								<td>' .  $item->tou_vehicle .'</td>
							</tr>
						</table>';
		});

		$dataGrid->addColumn('tou_teaser', 'Mô tả', 1, array('width' => 200));

		$dataGrid->addColumn('', 'Ngày đăng', 0, array('width' => 100), function($item){
			return date("d/m/Y", $item->tou_created_time);
		});

		$dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['tou_status'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/tours/active/'. $item['tou_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

      $dataGrid->addColumn('', 'Confirm', 0, array('width' => 30), function($item) {
         $classActive = $item['tou_confirm'] == 1 ? 'fa-check-square' : 'fa-square-o';
         return '<a class="btn-action btn-active-action" href="/admin/tours/confirm/'. $item['tou_id'] .'"><i class="fa '. $classActive .'"></i></a>';
      });

      $dataGrid->addColumn('', 'Hot', 0, array('width' => 30), function($item) {
         $classActive = $item['tou_hot'] == 1 ? 'fa-check-square' : 'fa-square-o';
         return '<a class="btn-action btn-active-action" href="/admin/tours/hot/'. $item['tou_id'] .'"><i class="fa '. $classActive .'"></i></a>';
      });

      $dataGrid->addColumn('', 'Sửa', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeEditButton(route('tours.edit', [$item->tou_id]));
		});

		$dataGrid->addColumn('', 'Xóa', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeDeleteButton(route('tours.delete', [$item->tou_id]));
		});

		$data_grid = $dataGrid->render(false);

		return View::make('backend/tours/unconfirm', compact('data_grid'));
	}

	public function getEdit($id = 0) {

		if (!$tour = $this->tour->getTourById($id)) return Redirect::to(route('tours.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		// Content
		$content   = $this->tour->getContentTourById($tour);
		// Lấy ảnh minh họa
		$photos    = $this->tour->getAllPhotoByTourId($tour);

		$weeks_db = '';
		if ($tour->tou_by_week != null) {
			$weeks_db = explode(',' , $tour->tou_by_week);
		}

		$cities    = $this->city->getAllCity();
		$weeks     = $this->getTypeByWeek();
		$countries = $this->mContry->getAllCountry();
        $tourTypes 	= Tour::getTypeNames();

		return View::make('backend/tours/edit', compact('tour', 'cities', 'weeks', 'countries', 'content', 'photos', 'weeks_db', 'tourTypes'));
	}

	public function postEdit($id = 0) {

		if (!$tour = $this->tour->getTourById($id)) return Redirect::back()->with('error', 'Không tìm thấy bản ghi phù hợp');

		if(!$this->validator->validate(Input::all(), false)) {
			return Redirect::back()->withInput()->withErrors($this->validator->getErrors());
		}

		$tour->tou_name 						= Xss::clean(Input::get('tou_name'));
		$tour->tou_tags 						= Xss::clean(Input::get('tou_tags'));
		$tour->tou_price						= Xss::clean(Input::get('tou_price'));
		$tour->tou_day 						= (int) Input::get('tou_day');
		$tour->tou_night 						= (int) Input::get('tou_night');
		$tour->tou_start_type 				= (int) Input::get('tou_start_type');
		$tour->tou_type 						= (int) Input::get('tou_type');
		$tour->tou_country_departure		= (int) Input::get('tou_country_departure');
		$tour->tou_city_departure			= (int) Input::get('tou_city_departure');
		$tour->tou_country_destination	= (int) Input::get('tou_country_destination');
		$tour->tou_place_destination		=	Xss::clean(Input::get('tou_place_destination'));
		$tour->tou_vehicle					=	Xss::clean(Input::get('tou_vehicle'));
		$tour->tou_teaser						=	Xss::clean(Input::get('tou_teaser'));
		$tour->tou_updated_time				=	time();

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
				$this->tour->savePostTags($tour, Input::get('tou_tags'));

				// Luu thong tin places
				$this->tour->saveTourPlace($tour, Input::get('tou_place_destination'));

				// Lưu thông tin vê tour
				$this->tour->saveContent($tour, [
					'tco_tour_schedule'	=>	Xss::clean(Input::get('tco_tour_schedule')),
					'tco_tour_policies'	=>	Xss::clean(Input::get('tco_tour_policies')),
					'tco_tour_comprise'	=>	Xss::clean(Input::get('tco_tour_comprise'))
				]);

				// Lưu thông tin hình ảnh về tour
				$uploadPhotoTour = $this->upload->uploadImageTour('tim_tour_image', 'resize', true);
				$this->tour->saveImages($tour, (array) $uploadPhotoTour['file_name']);
			}

			return Redirect::route('tours.index')->with('success', 'Cập nhật thông tin tour thành công');

		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Tạo mới không thành công. Vui lòng kiểm tra lại');
		}
	}


	public function getDelete($id = 0) {

		if (!$tour = $this->tour->getTourById($id)) return Redirect::to(route('tours.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		try {
			$this->tour->removeContentByTourId($tour);
			$this->tour->removePhotoByTourId($tour);

			$this->tour->delete($tour);
			DB::commit();

			return Redirect::route('tours.index')->with('success', 'Hoàn thành xóa tour thành công.');

		} catch (Exception $e) {
			DB::rollback();
    		return Redirect::route('tours.index')->with('errors', 'Không thể xóa tour.');
		}

		// if ($this->tour->delete($tour)) {
  //        return Redirect::route('tours.index')->with('success', 'Hoàn thành xóa tour thành công.');
  //     } else {
  //        return Redirect::route('tours.index')->with('errors', 'Không thể xóa tour.');
  //     }
	}

	public function getActive($id = 0, $type = 'tou_status') {

		if (!$tour = $this->tour->getTourById($id)) return Redirect::to(route('tours.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$json = array(
			'code' => 0,
			'message' => 'Có lỗi'
		);

		$tour->{$type} = !$tour->{$type};

		if ($tour->save()) {
			$json['status']	= $tour->{$type};
			$json['code']		= 1;
			$json['message']	= 'Cập nhật thành công';
			return Response::json($json);
		}
		else{
			$json['message'] = 'Cập nhật không thành công';
		}

		return Response::json($json);
	}

   public function getConfirm($id = 0) {
      return $this->getActive($id, 'tou_confirm');
   }

   public function getHot($id = 0) {
      return $this->getActive($id, 'tou_hot');
   }

}