<?php
use Fsd\Users\UserRepository;
use Fsd\Users\UserCreator;
use Fsd\Validators\LoginValidator;

class ForgotController extends BaseController {

	protected $layout = 'frontend/layouts/auth';

	public function __construct(UserRepository $userRepository) {
		parent::__construct();
		$this->userRepository = $userRepository;
	}

	public function getForgotPassword(){
		$this->metadata->setTitle('Quên mật khẩu');
		$this->view('frontend/auth/forgot-password');
	}

	public function postForgotPassword(){

	}

}