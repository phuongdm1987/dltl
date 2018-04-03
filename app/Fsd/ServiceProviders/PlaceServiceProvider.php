<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class PlaceServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// TODO: Implement register() method.
		return $this->app->singleton('Fsd\Places\PlaceRepository', 'Fsd\Places\DbPlaceRepository');
	}
}