<?php
namespace Controllers\Admin;

use AdminController;
use View;
use Fsd\Modules\Modules;
use Sentry;
use Redirect;
use Input;
use Validator;
use Response;

class ModulesController extends AdminController {

   /**
    * Listing
    */
   public function getIndex() {
      $modules = Modules::all();
      return View::make('backend/modules/index', compact('modules'));
   }

   /**
    * Create form
    */
   public function getCreate() {
      return View::make('backend/modules/create');
   }

   /**
    * Post create form
    */
   public function postCreate() {

      $rules = array(
         'name' => 'required',
         'link' => 'required',
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
         return Redirect::back()->withInput()->withErrors($validator);
      }

      $module             = new Modules;
      $module->name       = Input::get('name');
      $module->link       = Input::get('link');
      $module->order      = Input::get('order');
      $module->icon       = Input::get('icon');
      $module->active     = 1; // Default is active
      $module->time_create = time();

      if ($module->save()) {
         return Redirect::to("/admin/modules")->with('success', 'Module was successfully added.');
      }
      return Redirect::to("/admin/modules/create")->with('error', 'Module was not created, please try again.');
   }

   /**
    * Edit form
    */
   public function getEdit($moduleId = null) {

      if (!$module = Modules::find($moduleId)) {
         return Redirect::to('/admin/modules')->with('error', 'Không tìm thấy module.');
      }

      return View::make('backend/modules/edit', compact('module'));
   }

   /**
    * Post edit form
    */
   public function postEdit($moduleId = null) {

      $rules = array(
         'name' => 'required',
         'link' => 'required',
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
         return Redirect::back()->withInput()->withErrors($validator);
      }

      if (!$module = Modules::find($moduleId)) {
         return Redirect::to('/admin/modules')->with('error', 'Không tìm thấy module.');
      }

      $module->name       = Input::get('name');
      $module->link       = Input::get('link');
      $module->order      = Input::get('order');
      $module->icon       = Input::get('icon');

      if ($module->save()) {
         return Redirect::to("/admin/modules")->with('success', 'Module was successfully edited.');
      }
      return Redirect::to("/admin/modules/create")->with('error', 'Module was not updated, please try again.');
   }

   /**
    * Delete item
    */
   public function getDelete($moduleId = null) {

      if (!$module = Modules::find($moduleId)) {
         return Redirect::to('/admin/modules')->with('error', 'Không tìm thấy module.');
      }

      $module->delete();

      return Redirect::to('admin/modules')->with('success', 'Xóa module thành công.');
   }

   /**
    * Active item
    */
   public function getActive($moduleId = null) {
   	$json = array(
   		'code' => 0,
   		'message' => null
   	);

      if (!$module = Modules::find($moduleId)) {
         $json['message'] = 'Không tìm thấy module';
         return Response::json($json);
      }

      $module->active = !$module->active;

      if ($module->save()) {
			$json['code']		= 1;
			$json['status']	= $module->active;
      	return Response::json($json);
      }

      return Response::json($json);
   }
}