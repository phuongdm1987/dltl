<?php
namespace Fsd\Users;

interface UserCreatorListener {
	public function userCreationError($errors);
	public function userCreationValidError($error);
	public function userCreated($user);
}