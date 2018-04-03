<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\Countries\CountryRepository", "Fsd\Countries\DbCountryRepository");
	}
}