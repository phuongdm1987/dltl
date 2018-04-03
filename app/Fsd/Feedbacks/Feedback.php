<?php namespace Fsd\Feedbacks;


use Fsd\Core\Entity;

class Feedback extends Entity {
	public $table 				= 'feedbacks';
	protected $primaryKey 	= 'feed_id';
	public $timestamps    	= false;

	const SUBR_ACTIVE 	= 1;
	const SUBR_DEACTIVE 	= 0;

	protected $rules = [
		"email" => "required|email"
	];
}