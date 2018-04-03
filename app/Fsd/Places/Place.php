<?php namespace Fsd\Places;

use Fsd\Core\Entity;

class Place extends Entity {
	public $table				= 'places';
	protected $primaryKey	= 'pla_id';
	public $timestamps		= false;
	/*
	* Định nghĩa trạng thái
	*/
	const DRAFT 			= 0;
	const PUBLISHED 		= 1;

	const TYPE_INLAND  = 1;
	const TYPE_FOREIGN = 2;

   const NO_IMAGE  = 0;
   const HAS_IMAGE = 1;

	public static function getPlaceTypes() {
		return [self::TYPE_INLAND, self::TYPE_FOREIGN];
	}

	public function getUrl() {
		return route('tour.by.place', [$this->pla_id, removeTitle($this->pla_name)]);
	}

	public function getImage($type = '') {
		return $this->pla_image != null
				?	PATH_IMAGE_PLACE . $type . $this->pla_image
				:	'/assets/img/grey.gif';
	}

	public function tours() {
		return $this->belongsToMany('Fsd\Tours\Tour', 'tour_places', 'place_id', 'tour_id');
	}
}