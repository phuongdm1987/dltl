<?php namespace Controllers\Admin;

use AdminController;
use Fsd\Places\Place;
use Fsd\Places\PlaceRepository;
use Fsd\Cities\CityRepository;
use Fsd\CategoryPlaces\CatPlaceRepository;
use Fsd\Countries\CountryRepository;
use Fsd\Tours\Tour;
use Fsd\Validators\PlaceValidator;
use Libs\UploadService;
use View, Response, Request, Redirect, DataGrid, Input, App, Xss, Str;

class PlaceController extends AdminController {

	public function __construct(PlaceRepository $place,
										CityRepository $city,
										PlaceValidator $validator,
										UploadService $upload,
										CatPlaceRepository $cplace,
										CountryRepository $country) {
		parent::__construct();

		$this->place 		= $place;
		$this->city 		= $city;
		$this->validator 	= $validator;
		$this->upload 		= $upload;
		$this->cplace		= $cplace;
		$this->country 	= $country;
	}

	public function getIndex() {

      $q = Xss::clean(Input::get('q'));
      $place_image = (int) Input::get('place_image', -1);
      $params = [
         'q'           => $q,
         'place_image' => $place_image
      ];

		$places = $this->place->getPlaceByPagination($params, 25);

		$dataGrid = new DataGrid([
			'data' => $places,
			'pagination' => [
				'limit_record' => 25,
				'total_record' => $places->getTotal()
			]
		]);

      $dataGrid->addSearch(1,1, '', $dataGrid->_formMaker->text(array('name' => 'q', 'value' => Input::get('q'), 'placeholder' => 'Nhập tên địa danh', 'class' => 'btn-flat')));
      $html_option = '<option value="'. Place::HAS_IMAGE .'" ' . (Input::get("place_image", -1) == Place::HAS_IMAGE ? 'selected=""' : '') . '>Có ảnh</option>';
      $html_option .= '<option value="'. Place::NO_IMAGE .'" '. (Input::get("place_image", -1) == Place::NO_IMAGE ? 'selected=""' : '') .'>Không có ảnh</option>';

      $html = '<select class="form-control btn-flat" name="place_image">
               <option value="-1">-- Chọn thông tin ảnh --</option>
               '. $html_option .'</select>';
      $dataGrid->addSearch(1,2, '', $html);

		$dataGrid->addColumn('pla_id', 'ID', 1);
      $dataGrid->addColumn('', 'Ảnh', 0, ['width' => 320], function($item) {
         //Lay anh dau tien neu co
         $place_images = $this->place->getImagePlaceById($item);
         if (!empty($place_images)) {
            $str = '<ul style="padding: 0px;">';
            $i = 0;
            foreach ($place_images as $place_image) {
               $image = $place_image->pim_image;
               $str .= '<li style="list-style: none; width: 150px; height: 100px; overflow: hidden; padding: 5px; float: left;"><img style="width: 150px;" src="' . PATH_IMAGE_PLACE . $image . '" /></li>';
               if ($i == 3) break;
               $i++;
            }
            $str .= "<ul>";
            return $str;
         }
      });
      $dataGrid->addColumn('pla_name', 'Tên địa danh', 0);
		$dataGrid->addColumn('cit_name', 'Quận Huyện');

		$dataGrid->addColumn('', 'Edit', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeEditButton(route('place.edit', [$item->pla_id]));
		});

		$dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['pla_active'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/places/active/'. $item['pla_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

		$dataGrid->addColumn('', 'Delete', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeDeleteButton(route('place.delete', [$item->pla_id]));
		});

		$data_grid = $dataGrid->render(false);

		return View::make('backend/places/index', compact('data_grid'));
	}

	public function getAll() {
		return $this->place->getAllPlace();
	}

	public function getCreate() {

		$cities 		= $this->city->getAllCity();
		$cit_id 		= Input::old('pla_city_id', 0);
		$districts 	= $this->city->getDistrictsByCityId($cit_id);
		$cplaces 	= $this->cplace->getAllCatPlace();
        $countries 	= $this->country->getAllCountry();
        $tourTypes 	= Tour::getTypeNames();

		return View::make('backend/places/create', compact('cities', 'districts', 'cplaces', 'countries', 'tourTypes'));
	}

	public function postCreate() {

		if(!$this->validator->validate(Input::all(), false)) {
			return Redirect::back()->withInput()->withErrors($this->validator->getErrors());
		}

		$place						= $this->place->getInstance();
		$place->pla_name 			= Xss::clean(Input::get('pla_name'));
		$place->pla_slug 			= Xss::clean(Str::slug(Input::get('pla_name')));
		$place->pla_content		= Xss::clean(Input::get('pla_content'));
		$place->pla_description = Str::words($place->pla_content, $words = 100, $end = '...');
		$place->pla_longitude	= (float) Input::get('pla_longitude');
		$place->pla_latitude		= (float) Input::get('pla_latitude');
		$place->pla_type 			= (int) Input::get('pla_type');
		$place->pla_city_id 		= (int) Input::get('pla_city_id');
		$place->pla_district_id = (int) Input::get('pla_district_id');
		$place->pla_active 		= Place::PUBLISHED;
		$place->pla_sector 		= (int) Input::get('pla_sector');
		$place->pla_created_at 	= time();
		$place->pla_updated_at 	= time();

		$pla_images = [];
		$uploadImagePlace = $this->upload->uploadImagePlace('pla_image', 'no-resize', true);
		foreach((array) $uploadImagePlace['file_name'] as $key => $images) {
			$pla_images[] = $images;
		}
		if (isset($uploadImagePlace)) {
			$place->pla_image = isset($pla_images[0]) ? $pla_images[0] : '';
		}

		if($this->place->save($place)) {
			try {
				$this->place->saveImages($place, (array) $uploadImagePlace['file_name']);
			} catch (Exception $e) {}

			return Redirect::route('place.index')->with('success', 'Tạo địa danh thành công!');
		}

		return Redirect::back()->with('error', 'Tạo địa danh không thành công. Vui lòng kiểm tra lại');
	}

	public function getEdit($id = 0) {

		$place = $this->place->getPlaceById($id);

		if(!$place) return Redirect::to(route('place.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$cities 		= $this->city->getAllCity();
		$cit_id 		= Input::old('pla_city_id', 0);
		$districts 	= $this->city->getDistrictsByCityId($place->pla_city_id);
		$pladeImages = $this->place->getImagePlaceById($place);
		$cplaces 	= $this->cplace->getAllCatPlace();
		$countries 	= $this->country->getAllCountry();
        $tourTypes 	= Tour::getTypeNames();

		return View::make('backend/places/edit', compact('cities', 'districts', 'place', 'pladeImages', 'cplaces', 'countries', 'tourTypes'));
	}

	public function postEdit($id) {

		$place = $this->place->getPlaceById($id);

		if(!$place) return Redirect::to(route('place.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		if(!$this->validator->validate(Input::all(), false)) {
			return Redirect::route('place.create')->withErrors($this->validator->getErrors());
		}

		$place->pla_name 			= Xss::clean(Input::get('pla_name'));
		$place->pla_slug 			= Xss::clean(Str::slug(Input::get('pla_name')));
		$place->pla_content		= Xss::clean(Input::get('pla_content'));
		$place->pla_description = Str::words($place->pla_content, $words = 100, $end = '...');
		$place->pla_longitude	= Input::get('pla_longitude');
		$place->pla_latitude		= Input::get('pla_latitude');
		$place->pla_type 			= (int) Input::get('pla_type');
		$place->pla_city_id 		= (int) Input::get('pla_city_id');
		$place->pla_district_id = (int) Input::get('pla_district_id');
		$place->pla_sector 		= (int) Input::get('pla_sector');
		$place->pla_updated_at 	= time();
		$pla_images = [];

		$uploadImagePlace = $this->upload->uploadImagePlace('pla_image', 'no-resize', true);

		foreach((array) $uploadImagePlace['file_name'] as $key => $images) {
			$pla_images[] = $images;
		}

		if($place->pla_image == null) {
			if (isset($uploadImagePlace)) {
				$place->pla_image = isset($pla_images[0]) ? $pla_images[0] : '';
			}
		}

		if($this->place->save($place)) {
			try {
				$this->place->saveImages($place, (array) $uploadImagePlace['file_name']);
			} catch (Exception $e) {}

			return Redirect::route('place.index')->with('success', 'Cập nhật địa danh thành công!');
		}

		return Redirect::back()->with('error', 'Cập nhật địa danh không thành công. Vui lòng kiểm tra lại');
	}

	public function getDelete($id) {

		$place = $this->place->getPlaceById($id);

		if(!$place) return Redirect::to(route('place.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$this->place->removeImagePlaceById($place);

		$this->place->delete($place);

		return Redirect::to(route('place.index'))->with('success', 'Xóa thành công 1 bản ghi');
	}

	public function getActive($id) {

		$place = $this->place->getPlaceById($id);

		if(!$place) return Redirect::to(route('place.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$json = array(
			'code' => 0,
			'message' => 'Có lỗi'
		);

		$place->pla_active = !$place->pla_active;

		if ($place->save()) {
			$json['status']	= $place->pla_active;
			$json['code']		= 1;
			$json['message']	= 'Cập nhật thành công';
			return Response::json($json);
		}
		else{
			$json['message'] = 'Cập nhật không thành công';
		}

		return Response::json($json);
	}
}