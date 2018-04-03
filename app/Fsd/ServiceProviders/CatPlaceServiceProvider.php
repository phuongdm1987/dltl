<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class CatPlaceServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\CategoryPlaces\CatPlaceRepository", "Fsd\CategoryPlaces\DbCatPlaceRepository");
	}
}