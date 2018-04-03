<?php namespace Fsd\Validators;

class ProfileValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'fullname'    	=> 'required',
			'email'			=> 'required|email'
		];
	}

	public function messages()
	{
		return [
			'fullname.required'    	=> 'Vui lòng nhập họ và tên',
			'email.required'       	=> 'Vui lòng nhập email',
			'email.email'       		=> 'Vui lòng nhập đúng định dạng email'
		];
	}
}