<?php namespace Fsd\Subscribers;


use Fsd\Core\Entity;

class Subscriber extends Entity {
	public $table = 'subscribers';
	protected $primaryKey 	= 'sub_id';
	public $timestamps    	= false;

	const SUBR_ACTIVE = 1;
	const SUBR_DEACTIVE = 0;

	protected $rules = [
		"email" => "required|email"
	];
}