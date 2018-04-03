<?php namespace Fsd\Validators;

class ChangePassword extends AbstractValidator {

	public function rules()
	{
		return [
			'old_password'     => 'required|between:3,32',
			'password'         => 'required|between:3,32',
			'password_confirm' => 'required|same:password',
		];
	}

	public function messages()
	{
		return [
			'old_password.required' 		=> 'Vui lòng nhập mật khẩu hiện tại',
			'password.required' 				=> 'Vui lòng nhập mật khẩu mới',
			'password_confirm.required' 	=> 'Vui lòng nhập mật khẩu xác nhận',
			'password_confirm.same' 		=> 'Sai mật khẩu xác nhận',
		];
	}

}