<?php
use Fsd\Users\UserRepository;
use Fsd\Users\UserCreatorListener;
use Fsd\Users\UserCreator;
use Fsd\Validators\LoginValidator;

class LoginController extends BaseController {

	protected $layout = 'frontend/layouts/auth';

	public function __construct(UserRepository $userRepository, LoginValidator $validator) {
		parent::__construct();
		$this->userRepository = $userRepository;
		$this->validator      = $validator;
	}

	public function getLogin() {
		if(\Auth::check()) {
			return $this->redirectRoute('home');
		}

		$this->metadata->setTitle('Đăng nhập hệ thống');
		$this->view('frontend/auth/login');
	}

	public function postLogin(){
		if(!$this->validator->validate(Input::all(), false)) {
			return $this->loginError($this->validator->getErrors());
		}

		\Auth::attempt([
		   'email' => Xss::clean(Input::get('email')),
		   'password' => Xss::clean(Input::get('password'))
		], true);

		if(!\Auth::check()) {
			return $this->redirectBack(['error' => 'Email hoặc mật khẩu không chính xác'], Input::all());
		}

		$user = \Auth::getUser();

		if(!$user->activated) {
			\Auth::logout();
			return $this->accountIsNotActive();
		}

		return $this->loginSuccess();
	}


	public function loginError($errors) {
		return $this->redirectBack(['errors' => $errors], Input::all());
	}

	public function loginSuccess() {
		return $this->redirectTo(\Session::get('loginRedirect'));
	}

	public function accountIsNotActive() {
		return $this->redirectBack(['error' => 'Tài khoản của bạn chưa đưọc kích hoạt']);
	}
}