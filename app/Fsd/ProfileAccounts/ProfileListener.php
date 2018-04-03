<?php
/**
 * Created by PhpStorm.
 * User: daolv
 * Date: 26/03/2015
 * Time: 15:16
 */
namespace Fsd\ProfileAccounts;

interface ProfileListener {
	public function profileUpdateError($errors);
	public function profileUpdate($profile);
	public function profileFaild();
}