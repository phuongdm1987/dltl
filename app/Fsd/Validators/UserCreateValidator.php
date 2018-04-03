<?php namespace Fsd\Validators;

class UserCreateValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'email'       => 'required|email|unique:users,email',
			'fullname'    => 'required',
			'password'    => 'required',
			'repassword' => 'required|same:password'
		];
	}

	public function messages()
	{
		return [
			'fullname.required'    => 'Vui lòng nhập họ và tên',
			'password.required'    => 'Vui lòng nhập mật khẩu',
			'repassword.required' => 'Vui lòng nhập mật khẩu',
			'repassword.same'     => 'Mật khẩu không khớp nhau',
			'email.required'       => 'Vui lòng nhập email',
			'email.unique'         => 'Email này đã tồn tại, vui lòng chọn một email khác',
		];
	}
}