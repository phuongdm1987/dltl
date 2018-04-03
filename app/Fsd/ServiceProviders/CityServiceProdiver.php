<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class CityServiceProdiver extends ServiceProvider {

	public function register() {
		$this->app->singleton("Fsd\Cities\CityRepository", "Fsd\Cities\DbCityRepository");
	}

}