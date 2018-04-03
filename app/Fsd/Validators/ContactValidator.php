<?php
namespace Fsd\Validators;

class ContactValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'name'    => 'required',
			'email'   => 'required|email',
			'title'   => 'required',
			'content' => 'required'
		];
	}

	public function messages()
	{
		return [
			'name.required'    => 'Vui lòng nhập họ và tên',
			'email.required'   => 'Vui lòng nhập email',
			'email.email'      => 'Vui lòng nhập đúng định dạng email',
			'title.required'   => 'Vui lòng nhập tiêu đề',
			'content.required' => 'Vui lòng nhập nội dung'
		];
	}
}