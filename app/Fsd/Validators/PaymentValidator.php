<?php
namespace Fsd\Validators;

class PaymentValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'name'    => 'required',
			'phone'   => 'required',
			'address' => 'required'
		];
	}

	public function messages()
	{
		return [
			'name.required'    => 'Vui lòng nhập tên',
			'phone.required'   => 'Vui lòng nhập số điện thoại',
			'address.required' => 'Vui lòng nhập địa chỉ'
		];
	}
}