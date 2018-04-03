<?php namespace Fsd\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class BookingSeviceProvider extends ServiceProvider {
   public function register() {
      $this->app->singleton("Fsd\Bookings\BookingRepository", "Fsd\Bookings\DbBookingRepository");
   }
}