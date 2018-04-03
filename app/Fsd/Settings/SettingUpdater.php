<?php namespace Fsd\Settings;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class SettingUpdater {

	public function __construct(SettingRepository $setting, Request $request, Router $route) {
		$this->setting = $setting;
		$this->request = $request;
		$this->route   = $route;
	}

	public function saveSetting(SettingUpdaterListener $listener) {

	}
}