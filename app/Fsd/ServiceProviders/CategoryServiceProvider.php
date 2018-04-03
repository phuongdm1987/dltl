<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\Categories\CategoryRepository", "Fsd\Categories\DbCategoryRepository");
	}
}