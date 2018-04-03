<?php namespace Controllers\Account;
use AuthorizedController;

use View, Response, Request, Redirect, Input, App, Xss, Image, DB;
use Fsd\Users\UserRepository;
use Fsd\Validators\ProfileValidator;
use Fsd\Validators\ChangePassword;
use Libs\UploadService;

class ProfileController extends AuthorizedController {

	public function __construct(UserRepository $user, ProfileValidator $validator, ChangePassword $changepass, UploadService $upload) {

		$this->user       = $user;
		$this->validator  = $validator;
		$this->changepass = $changepass;
		$this->upload     = $upload;
		parent::__construct();
	}

	public function getIndex() {

		if (! $user = $this->user->getUserById($this->login->getId())) {
			throw new EntityNotFoundException('Không tìm thấy tài nguyên trong ' . get_called_class(), 404);
		}

		$this->metadata->setTitle('Thông tin cá nhân');

		return View::make('frontend/account/profile/index', compact('user'));
	}

	public function postProfile() {

		if (! $user = $this->user->getUserById($this->login->getId())) {
			throw new EntityNotFoundException('Không tìm thấy tài nguyên trong ' . get_called_class(), 404);
		}

		if(!$this->validator->validate(Input::all(), false)) {
			return Redirect::back()->withInput()->withErrors($this->validator->getErrors());
		}

		$user->fullname     = Xss::clean(Input::get('fullname'));
		$user->email        = Xss::clean(Input::get('email'));
		$user->phone        = Xss::clean(Input::get('phone'));
		$user->address      = Xss::clean(Input::get('address'));
		$user->bank_account = Xss::clean(Input::get('bank_account'));

		// Upload ảnh đại diện
		$resultUpload = $this->upload->uploadAvatarUser('avatar', 'no-resize', false);

		if($resultUpload['status'] > 0) {
			$user->avatar = $resultUpload['filename'];
		}

		if ($user->save()) {
			return Redirect::route('profile.index')->with('success', 'Cập nhật thông tin thành công.');
		}

		return Redirect::back()->with('error', 'Cập nhật thông tin không thành công. Vui lòng kiểm tra lại');
	}

	public function getChangepassword() {

		$this->metadata->setTitle('Đổi mật khẩu cá nhân');

		return View::make('frontend/account/profile/changepassword', compact('user'));
	}

	public function postChangepassword() {

		if (! $user = $this->user->getUserById($this->login->getId())) {
			throw new EntityNotFoundException('Không tìm thấy tài nguyên trong ' . get_called_class(), 404);
		}

		if(! $this->changepass->validate(Input::all(), false)) {
			return Redirect::back()->withInput()->withErrors($this->changepass->getErrors());
		}

		// Check the user current password
		if ( ! \Hash::check(Input::get('old_password'), $user->password)) {
			// Set the error message
			$this->messageBag->add('old_password', 'Mật khẩu hiện tại không chính xác.');

			// Redirect to the change password page
			return Redirect::back()->withInput()->withErrors($this->messageBag);
		}

		// Update the user password
		$user->password = \Hash::make(Input::get('password'));

		$user->save();

		// Redirect to the change-password page
		return Redirect::back()->with('success', 'Mật khẩu của bạn đã được cập nhật');
	}

}