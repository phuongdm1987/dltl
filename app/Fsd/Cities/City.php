<?php namespace Fsd\Cities;

use Fsd\Core\Entity;

class City extends Entity {
	public $table 				= 'cities';
	protected $primaryKey 	= 'cit_id';
	public $timestamps    	=	false;

	const ACTIVE 	= 1;
	const DEACTIVE = 0;

   const HOT   = 1;
   const NOHOT = 0;

   const INBOUND   = 0;
   const OUTBOUND  = 1;

	protected $rules = [
		"cit_name" => "required"
	];

   public function getUrl() {
      return route('tour.by.city', [$this->cit_id, removeTitle($this->cit_name)]);
   }

   public function getImage($type = '') {
      $img = file_exists(PATH_UPLOAD_IMAGE_CITY . $type . $this->cit_image) ? PATH_IMAGE_CITY . $type . $this->cit_image : 'http://placehold.it/225x150';
      // $img = $this->cit_image != null ?  PATH_IMAGE_CITY . $type . $this->cit_image :  '/assets/img/grey.gif';
      return $img;
   }
}