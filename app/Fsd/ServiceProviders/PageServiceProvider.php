<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\Pages\PageRepository", "Fsd\Pages\DbPageRepository");
	}
}