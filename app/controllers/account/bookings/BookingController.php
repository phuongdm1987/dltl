<?php
namespace Controllers\Account;

use Fsd\Bookings\Booking;
use Fsd\Bookings\BookingRepository;

use Fsd\Bookings\BookingUpdater;
use Fsd\Bookings\BookingUpdaterListener;

use AuthorizedController;

use View, Response, Request, Redirect, DataGrid, Input, App, Xss, Mail;

class BookingController extends AuthorizedController implements BookingUpdaterListener {

	public function __construct(BookingRepository $booking, BookingUpdater $updater) {
		$this->booking   = $booking;
		$this->updater   = $updater;
		parent::__construct();
	}

	public function getIndex() {
		$param                = [];
		$param['tou_user_id'] = $this->login->getId();
		$bookings             = $this->booking->getBookingsByPaginated($param, 15);
		return View::make('frontend.account.bookings.index', compact('bookings'));
	}

	public function getMyBooking() {
		$bookings = $this->booking->getBookingsByUser(20);
		return View::make('frontend.account.bookings.me', compact('bookings'));
	}

	public function getConfirm($bookingID)  {
		if ($record = $this->booking->getBookingById($bookingID)) {
			// Kiem tra quyen xoa don nay
			$record->boo_status = !$record->boo_status;

			$string_alert = "";
			if ($record->boo_status == BOOKING_NEW) {
				$string_alert = "hủy";
			}

			if ($record->save()) {
				return Redirect::route('account.booking.index')->with('success', 'Hoàn thành ' . $string_alert . ' xác nhận đơn tour ' . $record->boo_code . ' thành công.');
			}
		} else {
			return Redirect::to(route('account.booking.index'))->with('error', 'Không tìm thấy bản ghi phù hợp');
		}
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
