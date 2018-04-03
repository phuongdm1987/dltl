<?php namespace Fsd\Validators;

class UserUpdateValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'fullname'    => 'required'
		];
	}

	public function messages()
	{
		return [
			'fullname.required'    => 'Vui lòng nhập họ và tên'
		];
	}
}