<?php namespace Fsd\Permissions;
/**
 * Cấu hình các quyền trong file app/config/account_permission.php
 * Cấu hình before filter trong file app/routes.php cho từng route, vào đó xem demo
 */
use Illuminate\Database\DatabaseManager as DB;
use Illuminate\Auth\AuthManager as Auth;

class Bee {

	protected $db;

	protected $permission;

	public function __construct(DB $db, Permission $permission, Auth $auth)
	{
		$this->db         = $db;
		$this->auth       = $auth;
		$this->permission = $permission;
	}

	public function can($storeId, $permission)
	{
		$dbPermission = $this->permission->where('per_store_id', $storeId)
		                                 ->where('per_user_id', $this->auth->getUser()->id)
		                                 ->first();

		if(!$dbPermission) return false;

		$currentPermissions = json_decode($dbPermission->per_permission, true);

		if(array_key_exists($permission, $currentPermissions) && $currentPermissions[$permission] == 1) {
			return true;
		}

		return false;
	}
}