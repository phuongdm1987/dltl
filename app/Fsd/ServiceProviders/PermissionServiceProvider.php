<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->bind("bee", "Fsd\Permissions\Bee");
	}
}