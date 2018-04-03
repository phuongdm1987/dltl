<?php namespace Fsd\CategoryPlaces;

use Fsd\Core\Entity;

class CatPlace extends Entity {
	public $table 				= 'category_places';
	protected $primaryKey 	= 'ctp_id';
	public $timestamps    	=	false;

	const ACTIVE 	= 1;
	const DEACTIVE = 0;
}