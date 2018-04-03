<?php namespace Fsd\Permissions;

use Fsd\Core\Entity;

class Permission extends Entity {
	protected $table      = 'permissions';
	protected $primaryKey = 'per_id';
	public $timestamps    = false;
}