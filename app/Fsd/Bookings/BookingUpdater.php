<?php namespace Fsd\Bookings;

use Fsd\Tours\TourRepository;
use Fsd\Users\UserRepository;

use Mail;

class BookingUpdater {

	public function __construct(BookingRepository $booking, TourRepository $tour, UserRepository $user) {
		$this->booking 	= $booking;
		$this->tour 		= $tour;
		$this->user 		= $user;
	}

	public function changeStatusBooking(BookingUpdaterListener $listener, Booking $booking, $status) {

		$booking->boo_status = $status;

		if($bookingOnline = $this->booking->save($booking)) {
			$tour = $this->tour->getTourById($bookingOnline->boo_tour_id);

			$user = $this->user->getUserById($tour->tou_user_id);

			if($bookingOnline->boo_status == Booking::STATUS_RECEIVED) {
				Mail::send('emails/bookings/booking_online_notify', ['booking' => $bookingOnline, 'tour' => $tour, 'user' => $user], function($message) use($bookingOnline, $listener) {
					$message->to($bookingOnline->getCustomerEmail())->subject( $bookingOnline->getBookingCode() . ' – VnGoing xác nhận đặt tour');
				});
			}
			if($bookingOnline->boo_status == Booking::STATUS_SUCCESS) {
				Mail::send('emails/bookings/booking_online_payment', ['booking' => $bookingOnline, 'tour' => $tour], function($message) use($bookingOnline, $listener) {
					$message->to($bookingOnline->getCustomerEmail())->subject($bookingOnline->getBookingCode() .  ' - ' . $user->fullName()  . ' Xác nhận thanh toán thành công');
				});
			}
			return $listener->updationSuccess($bookingOnline);
		}
		return $listener->updationFailed();
	}
}