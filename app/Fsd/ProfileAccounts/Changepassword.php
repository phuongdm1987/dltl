<?php
/**
 * Created by PhpStorm.
 * User: daolv
 * Date: 26/03/2015
 * Time: 17:08
 */

namespace Fsd\ProfileAccounts;

use Fsd\Domains\DomainRepository;
use Fsd\Users\User;
use Fsd\Users\UserRepository;
use Fsd\Validators\ChangePasswordValidator;
use Illuminate\Http\Request;
use Xss;
use Hash;

class Changepassword {
	public function __construct(UserRepository $user, Request $request,
										 ChangePasswordValidator $validator){
		$this->user 		= $user;
		$this->request 	= $request;
		$this->validator 	= $validator;
	}

	public function changePassword(ChangePasswordListener $listener, User $user){
		if(!$this->validator->validate($this->request->all(), false)) {
			return $listener->changePasswordErrors($this->validator->getErrors());
		}

		$user->password = Hash::make($this->request->input('password'));

		if($user = $this->user->save($user)) {
			return $listener->changePassword($user);
		}

		return $listener->changePasswordFaild();
	}
}