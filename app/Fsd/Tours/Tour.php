<?php
namespace Fsd\Tours;

use Fsd\Core\Entity;

class Tour extends Entity {
	public $table          = 'tours';
	protected $primaryKey  = 'tou_id';
	public $timestamps     = false;

	const TYPE_INLAND = 1;
	const TYPE_FOREIGN = 2;
    const TYPE_COMBO = 3;
    const TYPE_CRUISE = 4;

	const TYPE = [
        self::TYPE_COMBO => [
            'name' => 'Combo du lịch',
            'slug' => 'combo-du-lich',
        ],
		self::TYPE_INLAND => [
            'name' => 'Tour trong nước',
            'slug' => 'tour-trong-nuoc',
        ],
		self::TYPE_FOREIGN => [
            'name' => 'Tour nước ngoài',
            'slug' => 'tour-nuoc-ngoai',
        ],
        self::TYPE_CRUISE => [
            'name' => 'Du thuyền Hạ Long',
            'slug' => 'du-thuyen-ha-long',
        ],
	];

	const STATUS_ACTIVE    = 1;
	const STATUS_INACTIVE  = 0;

	const STATUS_CONFIRM   = 1;
	const STATUS_UNCONFIRM = 0;

	public function getUrl() {
		return route('tour.detail', [$this->tou_id, removeTitle($this->tou_name)]);
	}

	public function getImage($prefix = '') {
		if ($this->tou_image == '' || !file_exists(PATH_UPLOAD_IMAGE_TOUR . $prefix . $this->tou_image)) return '/assets/img/200x150.png';
		return PATH_IMAGE_TOUR . $prefix . $this->tou_image;
	}

	public function getDayNight()
	{
		return "{$this->tou_day} ngày {$this->tou_night} đêm";
	}

	public static function getTourTypes() {
		return [self::TYPE_INLAND, self::TYPE_FOREIGN];
	}

	public function isInland()
	{
		return $this->type == self::TYPE_INLAND;
	}

	public function getPricePubRaw()
	{
		return $this->tou_price_pub > 0 ? $this->tou_price_pub : $this->tou_price + 500000;
	}

	public function getPricePub()
	{
		return format_number($this->getPricePubRaw());
	}

	public function getPrice() {
		return format_number($this->tou_price);
	}

	public function getPriceRaw() {
		return $this->tou_price;
	}

	public function getTextStatus() {

		$status = $this->tou_confirm;

		switch ($status) {
			case self::STATUS_CONFIRM :
				return '<label class="btn-success btn btn-xs btn-flat"> Đã duyệt </label>';
				break;

			case self::STATUS_UNCONFIRM :
				return '<label class="btn-warning btn btn-xs btn-flat"> Chờ duyệt </label>';
				break;

			default:
				return '<label class="btn-default btn btn-xs btn-flat"> Chưa xác định </label>';
				break;
		}
	}

	public function getTourStartType() {
		$type = $this->tou_start_type;
		$str_return = "";
		switch ($type) {
			case 1:
				$str_return = "Hàng ngày";
				break;

			case 2:
				$str_return = "Hàng tuần";
				break;

			case 3:
				$str_return = "Lịch cố định";
				break;
			default:
				$str_return = "";
				break;
		}
		return $str_return;
	}

	public function taggings() {
		return $this->belongsToMany('Fsd\Tags\Tag', 'tour_tags', 'tour_id');
	}

	public function placeings() {
		return $this->belongsToMany('Fsd\Places\Place', 'tour_places', 'tour_id');
	}

	public function city() {
		return $this->belongsTo('Fsd\Cities\City', 'tou_city_departure');
	}

	public function author() {
		return $this->belongsTo('Fsd\Users\User', 'tou_user_id');
	}

	public function getTags() {
		$tag_list = array();
		foreach ($this->taggings as $tag) {
			$tag_list[] = '<a href="/tim-kiem?q=' . $tag->slug .'" title="' . $tag->name . '">' . $tag->name . '</a>';
		}

		return implode(" ", $tag_list);
	}

	public function getPlace() {
		$place_list = array();
		foreach ($this->placeings as $place) {
			$place_list[] = $place->pla_name;
		}

		return implode(", ", $place_list);
	}

    public static function getTypeNames()
    {
        return array_map(function ($type) {
            return $type['name'];
        }, self::TYPE);
    }
}