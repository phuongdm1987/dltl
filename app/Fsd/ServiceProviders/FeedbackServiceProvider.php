<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class FeedbackServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// TODO: Implement register() method.
		return $this->app->singleton('Fsd\Feedbacks\FeedbackRepository', 'Fsd\Feedbacks\DbFeedbackRepository');
	}
}