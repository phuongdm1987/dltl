<?php

namespace Controllers\Admin;

use AdminController,
	View,
	Config,
	Fsd\Settings\Setting,
	Validator,
	Input,
	Redirect,
	Image;

class SettingsController extends AdminController {

   /**
    * Edit settings
    */
   public function getIndex() {

      $settings = Setting::find(1);

      if (! $settings) {
         $settings = (object) Config::get('configuration');
      }

      return View::make('backend/settings/index', compact('settings'));
   }

   /**
    * Update settings
    */
   public function postIndex() {

      $setting = Setting::find(1);

      if (!$setting) {
        $setting = new Setting;
      }

      $setting->title       = Input::get('title');
      $setting->keywords    = Input::get('keywords');
      $setting->description = Input::get('description');

      $setting->owner       = Input::get('owner');
      $setting->address     = Input::get('address');
      $setting->email       = Input::get('email');
      $setting->phone       = Input::get('phone');
      $setting->skype       = Input::get('skype');
      $setting->yahoo       = Input::get('yahoo');
      $setting->about       = Input::get('about');

      $setting->facebook    = Input::get('facebook');
      $setting->twitter     = Input::get('twitter');
      $setting->gplus       = Input::get('gplus');
      $setting->ga_code     = Input::get('ga_code');

      if ($setting->save()) {
        return Redirect::to('admin/setting/')->with('success', 'Cập nhật thành công');
      }

      return Redirect::to('admin/setting/')->with('error', 'Cập nhật thất bại');
   }
}