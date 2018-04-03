<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class SubscriberServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// TODO: Implement register() method.
		return $this->app->singleton('Fsd\Subscribers\SubscriberRepository', 'Fsd\Subscribers\DbSubscriberRepository');
	}
}