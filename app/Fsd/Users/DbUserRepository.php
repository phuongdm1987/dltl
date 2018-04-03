<?php
namespace Fsd\Users;
use Fsd\Core\EloquentRepository;
use Illuminate\Database\DatabaseManager as DB;
use Login;

class DbUserRepository extends EloquentRepository implements UserRepository {

	public function __construct(User $model, DB $db, Login $login)
	{
		$this->model = $model;
		$this->db    = $db;
		$this->login = $login;
	}

	public function getAll() {
      return $this->model->orderBy('id', 'DESC')->get();
	}

	public function getUserById($id) {
      return $this->model->find($id);
	}

	public function getUserByUname($username) {

	}

	public function getUserByEmail($email) {
      return $this->model->where('email', $email)->first();
	}

	public function checkPassword($password) {
		return $this->model->where('password', $password)->first();
	}

	public function searchUsers($username, $count = 5) {}

	public function getCurrentUser() {
		return $this->model->where('id', $this->login->getId())
								 ->select('email', 'fullname', 'gender', 'birthday', 'phone', 'fax', 'address', 'avatar')
		                   ->first();
	}


	public function getAdminPermissionsByUserId($userId) {
		return $this->db->table('admin_permissions')
		         ->where('ape_user_id', $userId)
		         ->first();
	}


	public function setAdminPermissions($userId, array $permissions) {
		if($user = $this->db->table('admin_permissions')->where('ape_user_id', $userId)->first()) {
			return $this->updateAdminPermissions($userId, $permissions);
		}

		return $this->insertAdminPermissions($userId, $permissions);
	}

	public function updateAdminPermissions($userId, array $permissions) {
		return $this->db->table('admin_permissions')
			             ->where('ape_user_id', $userId)
			             ->update([
		                     'ape_permissions' => json_encode($permissions)
		                  ]);
	}

	public function insertAdminPermissions($userId, array $permissions) {
		return $this->db->table('admin_permissions')
		                ->insertGetId([
		                     'ape_user_id' => $userId,
		                     'ape_permissions' => json_encode($permissions)
		                  ]);
	}


	public function getUserInfoById($userId, array $fields = array('*')) {
		$query = $this->model->where('id', $userId);

		foreach($fields as $field) {
			$query->addSelect($field);
		}

		return $query->first();
	}

}