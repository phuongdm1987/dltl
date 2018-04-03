<?php namespace Fsd\AdminPermissions;

use Illuminate\Auth\AuthManager as Auth;

class Fox {

	protected $db;

	protected $permission;

	public function __construct(Permission $permission, Auth $auth)
	{
		$this->auth       = $auth;
		$this->permission = $permission;
	}

	public function can($permission)
	{
		$dbPermission = $this->permission->where('ape_user_id', $this->auth->getUser()->id)
		                                 ->first();

		if(!$dbPermission) return false;

		$currentPermissions = json_decode($dbPermission->ape_permissions, true);

		if(array_key_exists($permission, $currentPermissions) && $currentPermissions[$permission] == 1) {
			return true;
		}

		return false;
	}

	public function hello()
	{
		echo 'heello';die;
	}
}