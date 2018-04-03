<?php
use Fsd\Tours\Tour;
use Fsd\Tours\TourRepository;
use Fsd\Users\UserRepository;

use Fsd\Bookings\Booking;
use Fsd\Bookings\BookingRepository;
use Fsd\Validators\BookingValidator;

class BookingController extends BaseController {

	public function __construct(TourRepository $tour, BookingRepository $booking, UserRepository $user, BookingValidator $validator) {
		$this->tour      = $tour;
		$this->booking   = $booking;
		$this->user      = $user;
		$this->validator = $validator;
		parent::__construct();
	}

	public function getBooking() {
		$tourID     = Input::get('tourID', 0);
		$tourDetail = $this->tour->getTourById($tourID);
		if (!$tourDetail) return Redirect::back()->with('error', 'Không tìm thấy tài nguyên');


		$this->metadata->setTitle("Đặt tour :: " . $tourDetail->tou_name);
		$this->metadata->setDescription($tourDetail->tou_name . ', tìm kiếm tour du lịch cực dễ dàng, tiện lợi, giá thấp nhất Việt Nam');

		$user	= $this->user->getUserById($tourDetail->tou_user_id);

		if(Request::isMethod('post')) {
			return $this->createBooking();
		}

		return View::make('frontend.home.booking', compact('tourDetail', 'user'));
	}

	public function createBooking() {
		$tourID = Input::get('tourID', 0);
		if ($tourDetail = $this->tour->getTourById($tourID)) {
			$bookings                           = new Booking;
			$array_data['boo_create_time']      = time();
			$array_data['boo_customer_name']    = Xss::clean(Input::get('name'));
			$array_data['boo_customer_phone']   = Xss::clean(Input::get('phone'));
			$array_data['boo_customer_email']   = Xss::clean(Input::get('email'));
			$array_data['boo_customer_address'] = Xss::clean(Input::get('address'));

			// Thong tin tour
			$price    = $tourDetail->getPriceRaw();
			$quantity = (int) Xss::clean(Input::get('quantity'));
			// Neu dang nhap thi luu thong tin ID user
			$user_id  = $this->login->getId();

			$array_data['boo_tour_id']        = (int) $tourID;
			$array_data['boo_time_departure'] = strtotime(str_replace("/", "-", Xss::clean(Input::get('time_departure'))));
			$array_data['boo_quantity']       = $quantity;
			$array_data['boo_tour_price']     = $price;
			$array_data['boo_money']          = $price * $quantity;
			$array_data['boo_user_id']        = $user_id;

			if(!$this->validator->validate(Input::all(), false)) {
				$url = $tourDetail->getUrl() . '#booking';
				return Redirect::to($url)->withInput()->withErrors($this->validator->getErrors());
			}

			$user	= $this->user->getUserById($tourDetail->tou_user_id);

			if ($this->booking->createBooking($bookings, $array_data)) {

				// Mail::send('emails/bookings/booking_online_success', ['booking' => $bookings, 'tour' => $tourDetail, 'user' => $user], function($message) use($bookings) {
				// 	$message->to($bookings->getCustomerEmail())->subject( $bookings->boo_code . ' – Xác nhận đặt tour tại ' . SITE_NAME);
				// });

				// Mail::send('emails/bookings/booking_online_send_auth', ['booking' => $bookings, 'user' => $user], function($mess) use($bookings, $user) {
				// 	$mess->to($user->getEmail())->subject('Bạn có đơn đặt tour tại ' . SITE_NAME . ' - ' .  $bookings->boo_code);
				// });

				return Redirect::to($bookings->urlTourSuccess());
			}

			return Redirect::back()->with('error', 'Đặt phòng không thành công. Vui lòng kiểm tra lại thông tin');

		} else {
			return Redirect::back()->with('error', 'Tour không tồn tại. Vui lòng kiểm tra lại!');
		}
	}

	public function getUrlSuccess($id = 0) {

		$this->metadata->setTitle('Đặt tour thành công');

		if (! $booking = $this->booking->getBookingById($id))  return Redirect::back()->with('error', 'Không tìm thấy tài nguyên');

		$tour = $this->tour->getTourById($booking->boo_tour_id);

		return View::make('frontend/home/booking_success', compact('booking', 'tour'));
	}

}