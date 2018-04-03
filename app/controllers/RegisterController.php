<?php

use Fsd\Users\UserRepository;
use Fsd\Users\UserCreatorListener;
use Fsd\Users\UserCreator;
use Fsd\Validators\RegisterValidator;
// use Session, Hash, Xss, Config;

class RegisterController extends BaseController implements UserCreatorListener {

	protected $layout = 'frontend/layouts/auth';

	public function __construct(UserRepository $userRepository, UserCreator $creator,
															 RegisterValidator $validator) {
		parent::__construct();
		$this->userRepository = $userRepository;
		$this->creator        = $creator;
		$this->validator      = $validator;
	}

	public function getRegister() {
		$this->metadata->setTitle('Đăng ký tài khoản');
		$this->view('frontend/auth/register');
	}

	public function postRegister()
	{
		// Validate
		if(!$this->validator->validate(Input::all(), false)) {
			return $this->userCreationError($this->validator->getErrors());
		}

		$user = $this->userRepository->getNew([
			'activated' => 0,
			'email'     => Xss::clean(Input::get('email')),
			'fullname'  => Xss::clean(Input::get('fullname')),
			'address'   => Xss::clean(Input::get('address')),
			'phone'     => valid_phone(Xss::clean(Input::get('phone'))),
			'password'  => Hash::make(Input::get('password'))
		]);

			if(!$user = $this->userRepository->save($user)) {
				$this->messageBag->add('Có lỗi xảy ra, vui lòng thử lại');
				 return $this->userCreationError($this->messageBag->getMessages());
			}

			return $this->userCreated($user);
	}


	public function getSuccess($email) {
		return View::make('frontend.auth.register_success')->with('email', $email);
	}

	 /**
		* User account activation page.
		*
		* @param  string  $actvationCode
		* @return
		*/
	 public function getActivate() {
			$this->metadata->setTitle('Kích hoạt tài khoản');
			// Kiem tra thong tin token
			$data = [];
			$data['email'] = Input::get('email');
			$data['time']  = Input::get('time');
			$data['token'] = Input::get('token');

			if ($this->activeUser($data)) {
				 return $this->getActiveSuccess($data['email']);
			} else {

			}
	 }

	 public function getActiveSuccess($email) {
			return View::make('frontend.auth.active_success')->with('email', $email);
	 }


	/**
	 * Handler user create error
	 *
	 * @param  mixed $errors
	 * @return mixed
	 */
	public function userCreationError($errors)
	{
		return $this->redirectBack(['errors' => $errors], Input::all());
	}

	/**
	 * Hanler user create success
	 *
	 * @param  mixed $user
	 * @return mixed
	 */
	public function userCreated($user)
	{
			// Gui email
			$data['email'] = $user->email;
			$this->sendMailActiveUser($user);
		return $this->redirectRoute('register.success', $data);
	}

	public function userCreationValidError($error) {

	}

	 public function sendMailActiveUser($user) {
			// Send the activation code through email
			$token = base64_encode(md5($user->email . time() . getenv('SECRET_STRING')));
			$data = array(
						'user'              => $user,
						'data'              => ['time' => date("Y"), 'email' => $user->email],
						'activationUrl'     => \URL::route('active-user') . "?email=" . $user->email . "&time=" . time() . "&token=" . $token,
				 );
			\Mail::send('emails.register-activate', $data, function($mail) use ($user)
			{
				 $mail->to($user->email, $user->last_name);
				 $mail->subject('Kích hoạt tài khoản ' . WEB_NAME);
			});
	 }

	 public function activeUser(array $params) {
			// Kiem tra thong tin token
			$email = array_get($params, 'email');
			$time  = array_get($params, 'time');
			$token = array_get($params, 'token');

			$token_check = base64_encode(md5($email . $time . getenv('SECRET_STRING')));

			if ($token == $token_check) {
				 $user = $this->userRepository->getUserByEmail($email);
				 $user->activated = 1;
				 if ($this->userRepository->save($user)) {
						return true;
				 }
			}
			return false;
	 }
}