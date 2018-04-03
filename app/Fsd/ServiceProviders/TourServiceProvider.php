<?php
namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class TourServiceProvider extends ServiceProvider {
   public function register() {
      $this->app->singleton("Fsd\Tours\TourRepository", "Fsd\Tours\DbTourRepository");
   }
}