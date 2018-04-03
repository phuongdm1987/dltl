<?php namespace Fsd\AdminPermissions;

use Fsd\Core\Entity;

class Permission extends Entity {
	protected $table      = 'admin_permissions';
	protected $primaryKey = 'ape_id';
	public $timestamps    = false;
}