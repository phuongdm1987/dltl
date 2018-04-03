<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\Users\UserRepository", "Fsd\Users\DbUserRepository");
		$this->app->singleton("Fsd\Users\RoleRepository", "Fsd\Users\DbRoleRepository");
		$this->app->singleton("Fsd\Users\PermissionRepository", "Fsd\Users\DbPermissionRepository");
	}
}