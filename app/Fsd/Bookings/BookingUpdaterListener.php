<?php namespace Fsd\Bookings;

interface BookingUpdaterListener {
	public function updationSuccess(Booking $booking);
	public function updationFailed();
}