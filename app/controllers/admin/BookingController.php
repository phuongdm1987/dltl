<?php namespace Controllers\Admin;

use AdminController;

use Fsd\Bookings\BookingRepository;
use Fsd\Bookings\Booking;

use Fsd\Bookings\BookingUpdater;
use Fsd\Bookings\BookingUpdaterListener;

use View, Redirect, Input, App, Xss, Str;

class BookingController extends AdminController implements BookingUpdaterListener{

	public function __construct(BookingRepository $booking, BookingUpdater $updater) {
		$this->booking    = $booking;
		$this->updater    = $updater;
		$this->listStatus = Booking::getListStatus();
		parent::__construct();
	}

	public function getIndex() {

		$q          = Xss::clean(Input::get('q'));
		$status     = (int) Input::get('status');

		$params     = ['q' => $q, 'status' => $status];

		$bookings   = $this->booking->getBookingByPagination($params, 15);

		$listStatus = $this->listStatus;

		return View::make('backend/bookings/index', compact('bookings', 'listStatus'));
	}

	public function changeStatus($bookingId = 0) {

		if (! $booking = $this->booking->getBookingById($bookingId))  return Redirect::back()->with('error', 'Không tìm thấy tài nguyên');

		$status = Input::get('status');

		return $this->updater->changeStatusBooking($this, $booking, $status);
	}

	public function updationSuccess(Booking $booking) {
		return [
			'code'    => 1,
			'message' => 'Cập nhật thành công',
			'order'   => $booking
		];
	}

	public function updationFailed() {
		return [
			'code'    => 0,
			'message' => 'Cập nhật không thành công'
		];
	}
}