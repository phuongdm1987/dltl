<?php namespace Fsd\Validators;

class CatPlaceValidator extends AbstractValidator {

	public function rules() {
		return [
			'ctp_name'			=> 'required'
		];
	}

	public function messages() {
		return [
			'ctp_name.required'				=> 'Vui lòng nhập loại địa danh'
		];
	}
}