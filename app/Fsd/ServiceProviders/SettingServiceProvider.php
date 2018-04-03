<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\Settings\SettingRepository", "Fsd\Settings\DbSettingRepository");
	}
}