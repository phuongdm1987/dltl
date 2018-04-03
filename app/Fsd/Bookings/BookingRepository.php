<?php namespace Fsd\Bookings;

interface BookingRepository {
	public function getBookingByPagination(array $params, $count = 25);
	public function createBookingDetails(Booking $booking, array $data);
   public function createBooking(Booking $booking, array $data);
}