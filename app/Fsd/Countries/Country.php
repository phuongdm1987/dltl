<?php namespace Fsd\Countries;

use Fsd\Core\Entity;

class Country extends Entity {
	public $table 				= 'countries';
	protected $primaryKey 	= 'cou_id';
	public $timestamps    	=	false;

	const ACTIVE 	= 1;
	const DEACTIVE = 0;

   const HOT   = 1;
   const NOHOT = 0;

   public function getUrl() {
      return route('tour.by.country', [$this->cou_id, removeTitle($this->cou_name)]);
   }

   public function getImage($type = '') {
      $img = $this->cou_image != null ?  PATH_IMAGE_COUNTRY . $type . $this->cou_image :  '/assets/img/grey.gif';
      return $img;
   }
}