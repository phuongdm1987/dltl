<?php
/**
 * Created by PhpStorm.
 * User: daolv
 * Date: 26/03/2015
 * Time: 15:15
 */
namespace Fsd\ProfileAccounts;

use Fsd\Domains\DomainRepository;
use Fsd\Users\User;
use Fsd\Users\UserRepository;
use Fsd\Validators\ProfileConUpdateValidator;
use Illuminate\Http\Request;
use Xss;
class ProfileUpdate {

	public function __construct(UserRepository $user, DomainRepository $domain, Request $request,
										 ProfileConUpdateValidator $validator){
		$this->user 		= $user;
		$this->domain 		= $domain;
		$this->request 	= $request;
		$this->validator 	= $validator;
	}

	public function updateProfile(ProfileListener $listener, User $user){

		if(!$this->validator->validate($this->request->all(), false)) {
			return $listener->profileUpdateError($this->validator->getErrors());
		}

		$user->fullname = Xss::clean($this->request->input('fullname'));
		$user->phone    = Xss::clean(valid_phone($this->request->input('phone')));
		$user->birthday = Xss::clean($this->request->input('birthday'));
		$user->address  = Xss::clean($this->request->input('address'));

		if($user = $this->user->save($user)) {
			return $listener->profileUpdate($user);
		}

		return $listener->profileFaild();
	}
}