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
use Banner;


class BannerController extends AdminController{

	protected $permission_key = 'Banner';

	protected $permission_prefix = 'banner';

	protected $configBannerPage, $configBannerPosition, $permissions;

	public function __construct() {

		parent::__construct();

		$config = Config::get('configuration');

		$this->configBannerPage = $config['config_banner_page'];
		$configBannerPosition = $config['config_banner_position'];

		foreach($configBannerPosition as $pos => $array) {
			$this->configBannerPosition[$pos] = $array['des'];
		}

		$permissions = Config::get('permissions');
		$permissions = $permissions[$this->permission_key];
		$this->permissions = array_pluck($permissions, 'permission');

	}

	public function getIndex()
	{
		if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.view')) {
         return App::abort('403');
      }

		$page		= Input::get('page', 1);
		$limit	= 25;
		$start	= $page * $limit - $limit;

		$orderby = !empty($_GET['field_sort']) ? $_GET['field_sort'] : 'ban_id';
		$order   = !empty($_GET['type_sort']) ? $_GET['type_sort'] : 'DESC';

		$sql_where = '';

		$total = Banner::whereRaw("1 " . $sql_where)
							->orderBy($orderby, $order)
							->count();

		$data = Banner::whereRaw("1 " . $sql_where)
							->orderBy($orderby, $order)
							->skip($start)->take($limit)->get();

		$grid = new DataGrid(array(
         'data' => $data,
         'pagination' => array(
				'total_record' => $total,
				'limit_record' => $limit
			)
      ));

      $grid->addColumn('ban_id', 'ID', 1);

      $grid->addColumn('ban_picture', 'Picture', 1, array(), function($item) {
      	return '<img src="'. PATH_BANNER . $item->ban_picture .'" height="50">';
      });

      $grid->addColumn('ban_link', 'Link', 1, array(), function($item) {
      	return '<a href="'. $item->ban_link .'" target="_blank">'. $item->ban_link .'</a>';
      });

      $grid->addColumn('ban_position', 'Position', 1, array(), function($item) {
      	return $this->configBannerPosition[$item->ban_position];
      });

      $grid->addColumn('ban_page', 'Page', 1, array(), function($item) {
      	return $this->configBannerPage[$item->ban_page];
      });

      $grid->addColumn('', 'Del', 0, array('width' => 30), function($item) use ($grid) {
			return $grid->makeDeleteButton(route('delete-banner', $item->ban_id));
		});

		$grid->addColumn('', 'Edit', 0, array('width' => 30), function($item) use ($grid){
			return $grid->makeEditButton(route('edit-banner', $item->ban_id));
		});

      $grid->addColumn('ban_active', 'Active', 1, array(), function($item) use ($grid) {
      	return $grid->makeActiveButton(route('active-banner', $item->ban_id), $item->ban_active);
      });

      $data_grid = $grid->render(false);

      return View::make('backend/banners/index', compact('data_grid'));
	}


	public function getEdit($id)
	{
		if ($id > 0 && !Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
         return App::abort('403');
      }

      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.create')) {
         return App::abort('403');
      }

      if($id > 0 && !$banner = Banner::find($id)) {
      	return Redirect::to('admin/banner')->with('error', 'Không tồn tại ID này.');
      }

      $action = 'edit';

      $banner = getModelByAction('Banner', $id);

      $configBannerPage = $this->configBannerPage;
      $configBannerPosition = $this->configBannerPosition;

      return View::make('backend/banners/create', compact('action', 'id', 'banner' ,'configBannerPage', 'configBannerPosition'));
	}

	public function postUpdate($id)
	{


		$banner = getModelByAction('Banner', $id);

		// echo '<pre>';
		// print_r($banner);die;

		$banner->ban_link       = Input::get('ban_link');
		$banner->ban_page       = Input::get('ban_page');
		$banner->ban_position   = Input::get('ban_position');
		$banner->ban_background = Input::get('ban_background');
		$banner->ban_time       = time();
		$banner->ban_user_id    = $this->login->getId();

		$image = new Image;
		$resultUpload = $image->upload('ban_picture', PATH_UPLOAD_BANNER, array(), 'no-resize');
		if($resultUpload['status'] > 0) {
			$banner->ban_picture = $resultUpload['filename'];
		}

		if ($banner->save()) {
         return Redirect::to('/admin/banner')->with('success', 'Cập nhật thành công 1 bản ghi');
      }

      return Redirect::to('/admin/banner')->with('error', 'Lỗi xảy ra');

	}

	public function getDelete($id)
	{
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.delete')) {
         return App::abort('403');
      }

		if(!$record = Banner::find($id)) {
			return Redirect::back()->with('error', 'Không tồn tại ID này.');
		}

		if($record->delete()) {
			return Redirect::back()->with('success', 'Xóa thành công.');
		}

		return Redirect::back()->with('error', 'Xóa không thành công.');
	}

	public function getActive($id)
	{
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
         return App::abort('403');
      }

		if(!$record = Banner::find($id)) {
			return Redirect::back()->with('error', 'Không tồn tại bản ghi');
		}

		 $json = array(
      	'code' => 0,
      	'message' => 'Có lỗi'
      );

      $record->ban_active = !$record->ban_active;

      if ($record->save()) {
         $json['code'] = 1;
         $json['status'] = $record->ban_active;
         $json['message'] = 'Cập nhật thành công';
      }else{
      	$json['message'] = 'Cập nhật không thành công';
      }

      return Response::json($json);
	}
}