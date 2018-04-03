<?php
/**
 * Created by PhpStorm.
 * User: daolv
 * Date: 26/03/2015
 * Time: 17:07
 */

namespace Fsd\ProfileAccounts;


interface ChangePasswordListener {
	public function changePasswordErrors($errors);
	public function changePassword($changepassword);
	public function changePasswordFaild();
}