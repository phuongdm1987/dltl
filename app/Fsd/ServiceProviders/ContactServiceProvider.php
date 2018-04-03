<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider {
	public function register() {
		$this->app->singleton("Fsd\Contacts\ContactRepository", "Fsd\Contacts\DbContactRepository");
	}
}