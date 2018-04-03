<?php
// use Controllers\Domain\DomainController;

class LogoutController extends BaseController {

	public function getLogout()
	{
		Auth::logout();
	}
}