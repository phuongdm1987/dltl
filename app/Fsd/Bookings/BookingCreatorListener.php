<?php namespace Fsd\Bookings;

interface BookingCreatorListener {
	public function creationFailed();
	public function creationValidFailed($errors);
	public function creationSuccess();
}