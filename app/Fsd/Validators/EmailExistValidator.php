<?php namespace Fsd\Validators;

class EmailExistValidator extends AbstractValidator {

	public function rules() {
		return [
			'email' => 'unique:users,email',
		];
	}

	public function messages() {
		return [
			'email.unique' => 'Email này đã tồn tại, vui lòng chọn một email khác',
		];
	}
}