<?php

use Fsd\Users\UserRepository;
use Fsd\Users\UserCreatorListener;
use Fsd\Users\UserCreator;
use Fsd\Validators\LoginValidator;

class AuthController extends BaseController {

	protected $userRepository;

	public function __construct(UserRepository $userRepository, UserCreator $creator, LoginValidator $validator) {
		parent::__construct();
		$this->userRepository = $userRepository;
		$this->creator        = $creator;
		$this->validator      = $validator;
	}


	/**
	 * Dang nhap admin
	 */
	public function getSignin() {
		$this->metadata->setTitle('Đăng nhập quản trị');

		// Is the user logged in?
		if (Auth::check()) {
			return Redirect::to(Auth::user()->getUrl());
		}

		// Show the page
		return View::make('frontend.auth.signin');
	}

	/**
	 * Account sign in form processing.
	 * @return Redirect
	 */
	public function postSignin()	{

		// Declare the rules for the form validation
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required',
		);

		$message = array(
			'email.required'    => 'Vui lòng nhập email',
			'email.email'       => 'Email không hợp lệ',
			'password.required' => 'Vui lòng nhập mật khẩu'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules, $message);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}


		// Try to log the user in
		$authen = Auth::attempt(Input::only('email', 'password'), Input::get('remember-me', 0));

		if($authen) {
	      $redirect = Session::get('loginRedirect');

	      if(!$redirect) $redirect = Auth::user()->getUrl();

			// Unset the page we were before from the session
			Session::forget('loginRedirect');

			// Redirect to the users page
			return Redirect::route('admin')->with('success', Lang::get('auth/message.signin.success'));
		}

		// Ooops.. something went wrong
		return Redirect::back()->withInput()->withErrors($this->messageBag);
	}


	/**
	 * Logout page.
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		\Auth::logout();

		// Redirect to the users page
		return Redirect::route('home')->with('success', 'Bạn đã đăng xuất khỏi hệ thống!');
	}

}
