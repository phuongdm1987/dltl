<?php
namespace Fsd\Validators;

class LoginValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'email'    => 'required|email|exists:users,email',
			'password' => 'required'
		];
	}

	public function messages()
	{
		return [
			'email.required'    => 'Vui lòng nhập email',
			'email.email'       => 'Không đúng định dạng email',
			'email.exists'      => 'Không tồn tại email này',
			'password.required' => 'Vui lòng nhập mật khẩu'
		];
	}
}