<?php namespace Controllers\Admin;

use AdminController;
use Fsd\Cities\City;
use Fsd\Cities\CityRepository;
use Fsd\Validators\CityValidator;
use Fsd\Countries\Country;
use Fsd\Countries\CountryRepository;
use Libs\UploadService;

use View, Response, Request, Redirect, DataGrid, Input, App, Xss, Str;

class CityController extends AdminController{

   public function __construct(CityRepository $city,
                               CountryRepository $country,
                               UploadService $upload,
                               CityValidator $validator) {
      parent::__construct();
      $this->city      = $city;
      $this->country   = $country;
      $this->upload    = $upload;
      $this->validator = $validator;
   }

   public function getIndex() {

      $q = Xss::clean(Input::get('q'));
      $params = [
         'q' => $q
      ];

      $datas = $this->city->getCityByPagination($params, 25);

      $dataGrid = new DataGrid([
         'data' => $datas,
         'pagination' => [
            'limit_record' => 25,
            'total_record' => $datas->getTotal()
         ]
      ]);

      $dataGrid->addSearch(1,1, '', $dataGrid->_formMaker->text(array('name' => 'q', 'value' => Input::get('q'), 'placeholder' => 'Nhập tỉnh thành phố', 'class' => 'btn-flat')));

      $dataGrid->addColumn('cit_id', 'ID', 1);
      $dataGrid->addColumn('', 'Ảnh', 0, ['width' => 150], function($item){
         $str = '';
         if ($item['cit_image'] != "") {
            $str = '<img src="' . PATH_IMAGE_CITY . $item['cit_image'] . '" style="width: 150px;">';
         }
         return $str;
      });

      $dataGrid->addColumn('cit_name', 'Tên tỉnh thành', 0);

      $dataGrid->addColumn('', 'Quốc gia', 0, ['width' => 150], function($item){
         return $item->cou_name;
      });

      $dataGrid->addColumn('', 'Edit', 0, ['width' => 30], function($item) use($dataGrid){
         return $dataGrid->makeEditButton(route('cities.edit', [$item->cit_id]));
      });

      $dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
         $classActive = $item['cit_active'] == 1 ? 'fa-check-square' : 'fa-square-o';
         return '<a class="btn-action btn-active-action" href="/admin/cities/active/'. $item['cit_id'] .'"><i class="fa '. $classActive .'"></i></a>';
      });

      $dataGrid->addColumn('', 'Hot', 0, array('width' => 30), function($item) {
         $classActive = $item['cit_hot'] == 1 ? 'fa-check-square' : 'fa-square-o';
         return '<a class="btn-action btn-active-action" href="/admin/cities/active/'. $item['cit_id'] .'?type=cit_hot"><i class="fa '. $classActive .'"></i></a>';
      });

      $dataGrid->addColumn('', 'Delete', 0, ['width' => 30], function($item) use($dataGrid){
         return $dataGrid->makeDeleteButton(route('cities.delete', [$item->cit_id]));
      });

      $data_grid = $dataGrid->render(false);

      return View::make('backend/cities/index', compact('data_grid'));
   }

   public function getEdit($id = 0) {

      if ($id > 0) {
         $city = $this->city->getCityById($id);
      } else {
         $city = $this->city->getInstance();
      }

      if(!$city) return Redirect::to(route('city.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

      $countries = $this->country->getAllCountry();

      if(Request::isMethod('post')) {
         return $this->postEdit($city);
      }

      // $countries  = $this->country->getAllCountry();

      return View::make('backend/cities/edit', compact('city', 'countries'));
   }

   public function postEdit($city) {
      // dd($city);

      if(!$this->validator->validate(Input::all(), false)) {
         return Redirect::back()->withInput()->withErrors($this->validator->getErrors());
      }

      $city->cit_name       = Xss::clean(Input::get('cit_name'));
      $city->cit_country_id = Input::get('cit_country_id');

      $uploadImageCity = $this->upload->uploadImageCity('cit_image', 'no-resize', false);
      if (isset($uploadImageCity) && $uploadImageCity['filename'] != "") {
         $city->cit_image = $uploadImageCity['filename'];
      }

      if ($city->save()) {
         return Redirect::route('cities.index')->with('success', 'Cập nhật thành công.');
      }
      return Redirect::back()->with('error', 'Không cập nhật được');
   }

   public function getDelete($id) {

      $city = $this->city->getCityById($id);

      if(!$city) return Redirect::to(route('city.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

      $this->city->delete($city);

      return Redirect::to(route('city.index'))->with('success', 'Xóa thành công 1 bản ghi');
   }

   public function getActive($id) {

      $type = Input::get('type');

      $field = 'cit_active';
      if ($type == 'cit_hot') {
         $field = 'cit_hot';
      }

      $city = $this->city->getCityById($id);

      if(!$city) return Redirect::to(route('city.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

      $json = array(
         'code' => 0,
         'message' => 'Có lỗi'
      );

      $city->{$field} = !$city->{$field};

      if ($city->save()) {
         $json['status']   = $city->{$field};
         $json['code']     = 1;
         $json['message']  = 'Cập nhật thành công';
         return Response::json($json);
      }
      else{
         $json['message'] = 'Cập nhật không thành công';
      }

      return Response::json($json);
   }

}