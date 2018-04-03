<?php
namespace Controllers\Admin;

use AdminController;
use View;
use Sentry;
use Redirect;
use Input;
use Validator;
use Grid;
use Category;
use Image;
use Config;
use Response;
use Sizes;
use App;
use Request;
use DataGrid;
use DB;
use Test;

class TestController extends AdminController {

	protected $permission_prefix = 'test';

	/**
	 * Listing page
	 */
	public function getIndex() {
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.view')) {
         return App::abort('403');
      }

      $page		= Input::get('page', 1);
		$limit	= 25;
		$start	= $page * $limit - $limit;

		$orderby = !empty($_GET['field_sort']) ? $_GET['field_sort'] : 'id';
		$order   = !empty($_GET['type_sort']) ? $_GET['type_sort'] : 'DESC';
	}


	/**
	 * Create new record
	 */
	public function getCreate() {
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.create')) {
         return App::abort('403');
      }

      $test = new Test;

      return View::make('backend/test/create', compact('test'));
	}

	/**
	 * Post create new record
	 */
	public function postCreate() {
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.create')) {
         return App::abort('403');
      }
	}


	/**
	 * Edit record
	 */
	public function getEdit($id) {
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
         return App::abort('403');
      }

      if(!$test = Test::find($id)) {
      	return Redirect::to('/admin/test')->with('error', 'Không tìm thấy bản ghi.');
      }

      return View::make('backend/test/create', compact('test'));
	}


	/**
	 * Post edit record
	 */
	public function postEdit($id) {
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
         return App::abort('403');
      }

      if(!$test = Test::find($id)) {
      	return Redirect::to('/admin/test')->with('error', 'Không tìm thấy bản ghi.');
      }
	}


	/**
	 * Delete record
	 */
	public function getDelete($id) {
		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
         return App::abort('403');
      }

      if(!$test = Test::find($id)) {
      	return Redirect::to('/admin/test')->with('error', 'Không tìm thấy bản ghi.');
      }
	}


	/**
	 * Active record
	 */
	public function getActive($id) {
		 $json = array(
      	'code' => 0,
      	'message' => 'Có lỗi'
      );

		// Check permission
      //
      if (!Sentry::getUser()->hasAccess($this->permission_prefix . '.edit')) {
      	$json['message'] = 'Bạn không có quyền thực hiện tác vụ này!';
         return Response::json($json);
      }

      if(!$test = Test::find($id)) {
       	$json['message'] = 'Không tìm thấy bản ghi phù hợp!';
      	return Response::json($json);
      }

      return Response::json($json);
	}
}