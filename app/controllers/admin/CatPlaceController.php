<?php namespace Controllers\Admin;

use AdminController;
use Fsd\CategoryPlaces\CatPlace;
use Fsd\CategoryPlaces\CatPlaceRepository;
use Fsd\Validators\CatPlaceValidator;

use View, Response, Request, Redirect, DataGrid, Input, App, Xss, Str;

class CatPlaceController extends AdminController{

	public function __construct(CatPlaceRepository $mCatPlace,
										CatPlaceValidator $validator) {
		parent::__construct();
		$this->mCatPlace	= $mCatPlace;
		$this->validator 	= $validator;
	}

	public function getIndex() {

		$datas = $this->mCatPlace->getCatPlaceByPagination();

		$dataGrid = new DataGrid([
			'data' => $datas,
			'pagination' => [
				'limit_record' => 25,
				'total_record' => $datas->getTotal()
			]
		]);

		$dataGrid->addColumn('ctp_id', 'ID', 1);
		$dataGrid->addColumn('ctp_name', 'Loại địa danh', 0);
		$dataGrid->addColumn('ctp_teaser', 'Mô tả ngắn', 0);

		$dataGrid->addColumn('', 'Edit', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeEditButton(route('cplace.edit', [$item->ctp_id]));
		});

		$dataGrid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['ctp_status'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/cplaces/active/'. $item['ctp_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

		$dataGrid->addColumn('', 'Delete', 0, ['width' => 30], function($item) use($dataGrid){
			return $dataGrid->makeDeleteButton(route('cplace.delete', [$item->ctp_id]));
		});

		$data_grid = $dataGrid->render(false);

		return View::make('backend/cat_places/index', compact('data_grid'));
	}

	public function getEdit($id = 0) {

		if($id > 0) {
			$cplace = $this->mCatPlace->getCatPlaceById($id);
		}else{
			$cplace = $this->mCatPlace->getInstance();
		}

		if(!$cplace) return App::abort(404);

		if(Request::isMethod('post')) {
			return $this->postEdit($cplace);
		}

		return View::make('backend/cat_places/edit', compact('cplace'));
	}

	/**
	* Hàm xử lý thêm mới, cập nhật loại địa danh
	*/
	public function postEdit($cplace){

		if(!$this->validator->validate(Input::all(), false)) {
			return Redirect::back()->withInput()->withErrors($this->validator->getErrors());
		}

		$cplace->ctp_name 	= Xss::clean(Input::get('ctp_name'));
		$cplace->ctp_teaser 	= Xss::clean(Input::get('ctp_teaser'));
		$cplace->ctp_status 	= CatPlace::ACTIVE;

		if ($cplace->save()) {
			return Redirect::route('cplace.index')->with('success', 'Thêm thành công.');
		}
		return Redirect::back()->with('error', 'Không thêm mới được');
	}

	/*
	* Hàm xóa loại địa danh
	*/

	public function getDelete($id = 0) {

		$cplace = $this->mCatPlace->getCatPlaceById($id);

		if(!$cplace) return Redirect::to(route('cplace.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$this->mCatPlace->delete($cplace);

		return Redirect::to(route('cplace.index'))->with('success', 'Xóa thành công 1 bản ghi');
	}

	public function getActive($id = 0) {

		$cplace = $this->mCatPlace->getCatPlaceById($id);

		if(!$cplace) return Redirect::to(route('cplace.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');

		$json = array(
			'code' => 0,
			'message' => 'Có lỗi'
		);

		$cplace->ctp_status = !$cplace->ctp_status;

		if ($cplace->save()) {
			$json['status']	= $cplace->ctp_status;
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