<?php namespace Fsd\Users;

interface UserRepository {
	public function getAll();
	public function getUserById($id);
	public function getUserByUname($username);
	public function getUserByEmail($email);
	public function searchUsers($username, $count = 5);
	public function getCurrentUser();
	public function checkPassword($password);

	/**
	 * Get Admin Permissions By UserId
	 *
	 * @param  integer $userId
	 * @return object
	 */
	public function getAdminPermissionsByUserId($userId);


	/**
	 * Set Admin Permissions By UserId
	 * Nếu chưa có thì insert, có rồi thì update
	 *
	 * @param integer $userId
	 * @param array  $permissions
	 */
	public function setAdminPermissions($userId, array $permissions);

	public function updateAdminPermissions($userId, array $permissions);

	public function insertAdminPermissions($userId, array $permissions);

	public function getUserInfoById($userId, array $fields = array('*'));

}