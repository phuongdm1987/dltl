<?php
namespace Controllers\Admin;

use AdminController;
use View;
use Background;
use Redirect;
use Validator;
use Input;
use Sentry;
use App;
use Response;
use Image;
use Config;
use DB;
use DataGrid;

class BackgroundsController extends AdminController{

	protected $permission_prefix = 'backgrounds';

	public $bac_position = array(
		1 => 'Home',
		2 => 'User',
		3 => 'Account'
	);


	/**
	 * Hỉển thị danh sách ảnh hiện có tại hệ thống
	 */

	public function getIndex(){

		$page		= Input::get('page', 1);
		$limit	= 25;
		$start	= $page * $limit - $limit;

		$orderby = !empty($_GET['field_sort']) ? $_GET['field_sort'] : 'bac_id';
		$order   = !empty($_GET['type_sort']) ? $_GET['type_sort'] : 'DESC';

		$total = DB::select("SELECT count(*) as count FROM backgrounds");
		$total = isset($total[0]) ? $total[0]->count : 0;

		$data = DB::select("SELECT * FROM backgrounds WHERE 1 ORDER BY $orderby $order LIMIT $start,$limit");
		$data = convertArrayObjToArray($data);

		$grid = new DataGrid(array(
         'data' => $data,
         'pagination' => array(
            'limit_record' => $limit,
            'total_record' => $total
         )
		));

		$grid->addColumn('bac_id', 'ID', 1);
		$grid->addColumn('bac_image', 'Anh', 0, array(), function($item) {
			return '<img width="50" height="50" src="'. PATH_IMAGE_BACKGROUNDS . $item['bac_image'] .'">';
		});
		$grid->addColumn('', 'Del', 0, array('width' => 30), function($item) {
			return '<a class="btn-action btn-delete-action" href="/admin/backgrounds/delete?recordId='. $item['bac_id'] .'"><i class="fa fa-trash-o text-danger"></i></a>';
		});

		$grid->addColumn('', 'Edit', 0, array('width' => 30), function($item) {
			return '<a class="btn-action btn-edit-action" href="/admin/backgrounds/edit?recordId='. $item['bac_id'] .'"><i class="fa fa-edit"></i></a>';
		});

		$grid->addColumn('', 'Atv', 0, array('width' => 30), function($item) {
			$classActive = $item['bac_active'] == 1 ? 'fa-check-square' : 'fa-square-o';
			return '<a class="btn-action btn-active-action" href="/admin/backgrounds/active?recordId='. $item['bac_id'] .'"><i class="fa '. $classActive .'"></i></a>';
		});

		$data_grid = $grid->render(false);

		return View::make('backend/backgrounds/index', compact('data_grid'));
	}

	/**
	 * Giao diện thao tác để thêm ảnh
	 */

	public function getCreate(){
		# Check permission
      if (!Sentry::getUser()->hasAccess($this->permission_prefix. '.create')) {
         return App::abort('403');
      }

		$positions = $this->bac_position;
		return View::make('backend.backgrounds.add', compact('positions'));
	}

	/**
	 * Giao diện thao tác để sửa ảnh
	 */

	public function postCreate(){
		# Check permission
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.create')) {
         return App::abort('403');
      }

      $rules = array(
			'bac_position' => 'required|min:1',
			'bac_image'    => 'required|image'
      );

      $messages = array(
			'bac_position.required' => 'Vui lòng chọn vị trí',
			'bac_image.required'    => 'Vui lòng chọn ảnh',
			'bac_image.image'       => 'định dạng sai'
      );

      $validator = Validator::make(Input::all(), $rules, $messages);

      if ($validator->fails()) {
         return Redirect::back()->withInput()->withErrors($validator);
      }

      $background = new Background();
      $background->bac_position = Input::get('bac_position');
      $background->bac_active = 1;

       // Upload & resize image
		$image = new Image();
		$configuration = Config::get('configuration');
		$arrayResize   = $configuration['array_background'];
		$resultUpload = $image->upload('bac_image', PATH_UPLOAD_IMAGE_BACKGROUNDS, $arrayResize);

		if ($resultUpload['status'] > 0) {
		 	$background->bac_image = $resultUpload['filename'];
		}

		if ($background->save()) {
			return Redirect::to('/admin/backgrounds')->with('success', 'Thêm thành công.');
		}

		return Redirect::to('/admin/backgrounds')->with('error', 'Không thêm mới được');

	}

	/**
	 * Xử lý thêm background và lưu thông tin vào db
	 */

	public function getEdit(){
		# Check permission
      if (!Sentry::getUser()->hasAccess($this->permission_prefix .'.edit')) {
         return App::abort('403');
      }

      if(!$record = Background::find(Input::get('recordId'))) {
			return Redirect::to('admin/backgrounds')->with('error', 'Không tồn tại ID này.');
		}

		$positions = $this->bac_position;

		return View::make('backend.backgrounds.edit', compact('record', 'positions'));
	}

	/**
	 * Xử lý sửa background và lưu thông tin vào db
	 */

	public function postEdit(){
		# Check permission
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
         return App::abort('403');
      }

      if(!$record = Background::find(Input::get('recordId'))) {
			return Redirect::to('admin/backgrounds')->with('error', 'Không tồn tại ID này.');
		}

      $rules = array(
			'bac_position' => 'required|min:1'
      );

      $messages = array(
			'bac_position.required'		=> 'Chọn vị trí cần hiển thị',
      );

      $validator = Validator::make(Input::all(), $rules, $messages);

      if ($validator->fails()) {
         return Redirect::back()->withInput()->withErrors($validator);
      }

      $record->bac_position = Input::get('bac_position');

       // Upload & resize image
		$image = new Image();
		$configuration = Config::get('configuration');
		$arrayResize   = $configuration['array_background'];
		$resultUpload = $image->upload('bac_image', PATH_UPLOAD_IMAGE_BACKGROUNDS, $arrayResize);

		if ($resultUpload['status'] > 0) {
		 	$record->bac_image = $resultUpload['filename'];
		}

		if ($record->save()) {
         return Redirect::to('/admin/backgrounds/edit?recordId=' . $record->bac_id)->with('success', 'Cập nhật thành công.');
      }

      return Redirect::to('/admin/backgrounds')->with('error', 'Cập nhật thất bại');
	}

	/**
	 * Xoa background
	 */
	public function getDelete(){
		# Check permission
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.delete')) {
         return App::abort('403');
      }

		$id = Input::get('recordId');

		if(!$record = Background::find($id)) {
			return Redirect::back()->with('error', 'Không tồn tại ID này.');
		}

		if($record->delete()) {
			return Redirect::back()->with('success', 'Xóa thành công.');
		}

		return Redirect::back()->with('error', 'Xóa không thành công.');
	}

	/**
	 * Active background
	 */

	public function getActive(){
		# Check permission
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
         return App::abort('403');
      }

		$id = Input::get('recordId');

		if (!$record = Background::find($id)) {
         return Redirect::to('/admin/backgrounds')->with('error', 'Không tìm thấy bản ghi phù hợp.');
      }

      $json = array(
      	'code' => 0,
      	'message' => 'Có lỗi'
      );

      $record->bac_active = !$record->bac_active;

      if ($record->save()) {
			$json['status']	= $record->bac_active;
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