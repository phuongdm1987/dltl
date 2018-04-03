<?php namespace Controllers\Admin;

use AdminController;
use Fsd\Countries\Country;
use Fsd\Countries\CountryRepository;
use Fsd\Validators\CountryValidator;
use Libs\UploadService;

use View, Response, Request, Redirect, DataGrid, Input, App, Xss, Str;

class CountryController extends AdminController{

	public function __construct(CountryRepository $country,
                              UploadService $upload,
										CountryValidator $validator) {
		parent::__construct();
      $this->country = $country;
		$this->upload	= $upload;
		$this->validator 	= $validator;
	}

	public function getIndex() {

		$datas = $this->country->getCountryByPagination(25);

		$dataGrid = new DataGrid([
			'data' => $datas,
			'pagination' => [
				'limit_record' => 25,
				'total_record' => $datas->getTotal()
			]
		]);

		$dataGrid->addColumn('cou_id', 'ID', 1);
      $dataGrid->addColumn('', 'Ảnh', 0, ['width' => 150], function($item){
         $str = '';
         if ($item['cou_image'] != "") {
            $str = '<img src="' . PATH_IMAGE_COUNTRY . $item['cou_image'] . '" style="width: 150px;">';
         }
         return $str;
      });
		$dataGrid->addColumn('cou_code', 'Mã quốc gia', 0);
		$dataGrid->addColumn('cou_name', 'Tên quốc gia', 0);

		$dataGrid->addColumn('', 'Edit', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeEditButton(route('country.edit', [$item->cou_id]));
		});

		$dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['cou_active'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/countries/active/'. $item['cou_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

      $dataGrid->addColumn('', 'Hot', 0, array('width' => 30), function($item) {
         $classActive = $item['cou_hot'] == 1 ? 'fa-check-square' : 'fa-square-o';
         return '<a class="btn-action btn-active-action" href="/admin/countries/active/'. $item['cou_id'] .'?type=cou_hot"><i class="fa '. $classActive .'"></i></a>';
      });

		$dataGrid->addColumn('', 'Delete', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeDeleteButton(route('country.delete', [$item->cou_id]));
		});

		$data_grid = $dataGrid->render(false);

		return View::make('backend/countries/index', compact('data_grid'));
	}

	public function getEdit($id = 0) {

		if($id > 0) {
			$country = $this->country->getContryById($id);
		}else{
			$country = $this->country->getInstance();
		}

		if(!$country) return App::abort(404);

		if(Request::isMethod('post')) {
			return $this->postEdit($country);
		}

		return View::make('backend/countries/edit', compact('country'));
	}

	/**
	* Hàm xử lý thêm mới, cập nhật loại địa danh
	*/
	public function postEdit($country){

		if(!$this->validator->validate(Input::all(), false)) {
			return Redirect::back()->withInput()->withErrors($this->validator->getErrors());
		}

		$country->cou_code 		= Xss::clean(Input::get('cou_code'));
		$country->cou_name 		= Xss::clean(Input::get('cou_name'));
		$country->cou_active 	= Country::ACTIVE;

      $uploadImageCity = $this->upload->uploadImageCountry('cou_image', 'no-resize', false);
      if (isset($uploadImageCity) && $uploadImageCity['filename'] != "") {
         $country->cou_image = $uploadImageCity['filename'];
      }

		if ($country->save()) {
			return Redirect::route('country.index')->with('success', 'Thêm thành công.');
		}
		return Redirect::back()->with('error', 'Không thêm mới được');
	}

	/*
	* Hàm xóa loại địa danh
	*/

	public function getDelete($id = 0) {

		$country = $this->country->getContryById($id);

		if(!$country) return Redirect::to(route('country.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$this->country->delete($country);

		return Redirect::to(route('country.index'))->with('success', 'Xóa thành công 1 bản ghi');
	}

	public function getActive($id = 0) {

      $type = Input::get('type');

      $field = 'cou_active';
      if ($type == 'cou_hot') {
         $field = 'cou_hot';
      }

		$country = $this->country->getContryById($id);

		if(!$country) return Redirect::to(route('country.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$json = array(
			'code' => 0,
			'message' => 'Có lỗi'
		);

		$country->{$field} = !$country->{$field};

		if ($country->save()) {
			$json['status']	= $country->{$field};
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