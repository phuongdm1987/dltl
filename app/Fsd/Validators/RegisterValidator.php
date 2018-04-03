<?php
namespace Fsd\Validators;

class RegisterValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'email'       => 'required|email|unique:users,email',
			'phone'       => 'required',
			'password'    => 'required',
			're-password' => 'required|same:password'
		];
	}

	public function messages()
	{
		return [
			'email.required'       => 'Vui lòng nhập email',
			'email.email'          => 'Vui lòng nhập đúng định dạng email',
			'email.unique'         => 'Email này đã tồn tại, vui lòng chọn một email khác',
			'phone.required'       => 'Vui lòng nhập số điện thoại',
			'password.required'    => 'Vui lòng nhập mật khẩu',
			're-password.required' => 'Vui lòng nhập lại mật khẩu',
			're-password.same'     => 'Mật khâu không khớp nhau'
		];
	}
}