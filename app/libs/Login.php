<?php

class Login {

	protected $id = 0;

	protected $logged;

	protected $user;

	public function __construct() {
		if( Auth::check() && ($user = Auth::user()) ) {
			$this->id     = $user->id;
			$this->logged = true;
			$this->user   = $user;
		}
	}

	public function check() {
		return $this->logged;
	}

	public function getUser() {
		return $this->user;
	}

	public function getId() {
		return $this->id;
	}
}