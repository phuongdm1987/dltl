<?php namespace Fsd\Contacts;

use Fsd\Core\Entity;

class Contact extends Entity {
	protected $primaryKey = 'con_id';
	public $timestamps    = false;
}