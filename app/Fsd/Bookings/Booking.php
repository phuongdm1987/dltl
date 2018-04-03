<?php namespace Fsd\Bookings;

use Fsd\Core\Entity;

class Booking extends Entity {
	protected $primaryKey = 'boo_id';
	public $timestamps    = false;
	protected $table      = 'bookings';

	const STATUS_WAITING  = 0; // Booking đặt mới
	const STATUS_RECEIVED = 1; // Xác nhận booking
	const STATUS_SUCCESS  = 2; // Thanh toán thành công
	const STATUS_COMPLETE = 3; // Booking hoàn thành
	const STATUS_CANCEL   = 4; // Booking hủy

	public function hasColumn($column_name) {
		$query = 'SHOW COLUMNS FROM '.$this->table;
		$columns_list = array();

		foreach(\DB::select($query) as $columns)
		{
			$columns_list[] = $columns->Field;
		}

		if (in_array($column_name, $columns_list)) {
			return true;
		}
		return false;
	}

	public function getTextStatus() {
		switch ($this->getStatus()) {
			case self::STATUS_WAITING:
				return 'Booking đặt mới';

			case self::STATUS_RECEIVED:
				return 'Xác nhận booking';

			case self::STATUS_SUCCESS:
				return 'Thanh toán thành công';

			case self::STATUS_COMPLETE:
				return 'Booking hoàn thành';

			case self::STATUS_CANCEL:
				return 'Hủy';

			default:
				return 'Không xác định';
		}
	}

	public function getCssBtnStatus() {
		switch ($this->getStatus()) {
			case self::STATUS_WAITING:
				return 'btn-warning';

			case self::STATUS_RECEIVED:
				return 'btn-info';

			case self::STATUS_SUCCESS:
				return 'btn-success';

			case self::STATUS_COMPLETE;
				return 'btn-success';

			case self::STATUS_CANCEL:
				return 'btn-danger';

			default:
				return 'btn-default';
		}
	}

	public static function getListStatus() {
		return [
			self::STATUS_WAITING  => 'Booking đặt mới',
			self::STATUS_RECEIVED => 'Xác nhận booking',
			self::STATUS_SUCCESS  => 'Thanh toán thành công',
			self::STATUS_COMPLETE => 'Booking hoàn thành',
			self::STATUS_CANCEL   => 'Hủy'
		];
	}

	public function getId() {
		return $this->boo_id;
	}

	public function getStatus() {
		return $this->boo_status;
	}

	public function getCustomerName() {
		return $this->boo_customer_name;
	}

	public function getCustomerPhone() {
		return $this->boo_customer_phone;
	}

	public function getCustomerAddress() {
		return $this->boo_customer_address;
	}

	public function getCustomerEmail() {
		return $this->boo_customer_email;
	}

	public function getCustomerNote() {
		return $this->boo_customer_note;
	}

	public function getBookingCode() {
		return $this->boo_code;
	}

	public function getCreatedAt()
	{
		return $this->boo_create_time <= 0 ? '<i>Đang cập nhật</i>' : date('d-m-Y', $this->boo_create_time);
	}

	public function getDepartureAt()
	{
		return $this->boo_time_departure <= 0 ? '<i>Không chọn</i>' : date('d-m-Y', $this->boo_time_departure);
	}

	public function urlTourSuccess() {
      return route('booking.success', [$this->boo_id, $this->boo_code]);
   }
}