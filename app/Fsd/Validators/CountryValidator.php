<?php namespace Fsd\Validators;

class CountryValidator extends AbstractValidator {

	public function rules() {
		return [
			'cou_name'			=> 'required'
		];
	}

	public function messages() {
		return [
			'cou_name.required'	=> 'Vui lòng nhập tên quốc gia'
		];
	}
}