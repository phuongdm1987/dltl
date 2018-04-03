<?php
/**
 * User: alvintran
 * Date: 2/25/15
 * Time: 10:47 PM
 */

namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider {
	public function register(){
		$this->app->singleton("Fsd\Tags\TagRepository", "Fsd\Tags\DbTagRepository");
	}
}