<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\Posts\PostRepository", "Fsd\Posts\DbPostRepository");
	}
}