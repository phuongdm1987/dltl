<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class TestimonialServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton("Fsd\Testimonials\TestimonialRepository", "Fsd\Testimonials\DbTestimonialRepository");
	}

}