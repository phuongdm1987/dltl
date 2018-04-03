<?php namespace Fsd\Bookings;

use Fsd\Core\EloquentRepository;
use Login;
class DbBookingRepository extends EloquentRepository implements BookingRepository {

	public function __construct(Booking $booking, Login $login) {
		$this->model = $booking;
		$this->login = $login;
	}

	public function getBookingByPagination(array $params, $count = 25) {
		$q      = array_get($params, 'q');
		$status = (int) array_get($params, 'status');

		$query  = $this->model->join('tours', 'tou_id', '=', 'boo_tour_id')
									->join('users', 'id', '=', 'tours.tou_user_id')
									->orderBy('boo_create_time', 'DESC')
									->select('tours.*', 'bookings.*', 'users.fullname', 'users.email', 'users.phone');

		$query->where(function($where) use($q) {
			$where->where('boo_code', 'LIKE', '%'. $q .'%');
		});

		$query->where(function($q) use($status) {
			if($status) {
				$q->where('boo_status', $status);
			}
		});

		return $query->paginate($count);
	}

	public function createBookingDetails(Booking $booking, array $data) {
		foreach ($data as $field => $value) {
			if ($booking->hasColumn($field)) {
				$booking->{$field} = $value;
			}
		}
		$booking->save();
	}
	/**
	 * Ham tao don phong khi KH dat
	 * @param  Booking $booking Doi tuong model booking
	 * @param  array   $data    mang du lieu muon them moi dua theo cac truong cua bang bookings
	 * @return
	 */
	public function createBooking(Booking $booking, array $data)
	{
		foreach ($data as $field => $value) {
			if ($booking->hasColumn($field)) {
				$booking->{$field} = $value;
			}
		}
		//Update booking code
		if ($booking->save()) {
			$booking->boo_code = $this->generateBookingCode($booking->boo_id);
			$booking->save();
		}
		return $booking->save();
	}

	function generateBookingCode($booking_id){
		$prefix  =  "T";
		// New code by Alvin
		//
		$length      = 5;
		$offset      = rand(0, 26);
		$hash        = strtoupper(md5($booking_id));
		$last_string = substr($hash, $offset, $length);
		$final_code  = $prefix . $last_string;

		// Ktra tồn tại
		//
		$check = $this->model->where('boo_code', '=', $final_code)->get()->toArray();
		if (!empty($check)) {
			return $this->generateBookingCode($booking_id);
		}

		return $final_code;
	}

	public function getBookingById($id) {
		return $this->model->find($id);
	}

	public function getBookingsByPaginated(array $params, $count = 25)
	{
		$user_id = array_get($params, 'tou_user_id');

		$query = $this->getQueryBooking();
		$query->where('tou_user_id', '=', $user_id);

		return $query->paginate($count);
	}

	public function getBookingsByUser($count = 25) {
		return $this->getQueryBooking()
						->where('boo_user_id', $this->login->getId())
						->paginate($count);
	}

	public function getQueryBooking() {
		return $this->model->join('tours', 'boo_tour_id', '=', 'tou_id')
									->orderBy('boo_create_time', 'DESC');
	}
}