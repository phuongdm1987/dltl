<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class AdminPermissionServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->bind("fox", "Fsd\AdminPermissions\Fox");
	}
}