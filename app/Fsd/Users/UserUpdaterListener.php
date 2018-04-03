<?php namespace Fsd\Users;

interface UserUpdaterListener {
	public function findNotFound($user = null);
	public function updationValidError($errors);
	public function updationFail();
	public function updated($user = null);
	public function deletionError();
	public function deleted();
}