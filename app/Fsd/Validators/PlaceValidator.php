<?php namespace Fsd\Validators;

class PlaceValidator extends AbstractValidator {

	public function rules() {
		return [
			'pla_name'			=> 'required',
			'pla_type'			=> 'required|integer|min:1',
			'pla_city_id'		=> 'required|integer|min:1',
			// 'pla_district_id'	=> 'required|integer|min:1',
			// 'pla_image'			=> 'required|image',
		];
	}

	public function messages() {
		return [
			'pla_name.required'				=> 'Vui lòng nhập tên địa danh',
			'pla_city_id.required'			=> 'Vui lòng lựa chọn thành phố',
			'pla_city_id.integer'			=> 'Vui lòng lựa chọn thành phố',
			'pla_city_id.min'					=> 'Vui lòng lựa chọn thành phố',
			// 'pla_district_id.required'		=> 'Vui lòng lựa chọn quận huyện',
			// 'pla_district_id.integer'		=> 'Vui lòng lựa chọn quận huyện',
			// 'pla_district_id.min'			=> 'Vui lòng lựa chọn quận huyện',
			'pla_type.required'				=> 'Vui lòng lựa chọn loại địa danh',
			'pla_type.integer'				=> 'Vui lòng lựa chọn loại địa danh',
			'pla_type.min'						=> 'Vui lòng lựa chọn loại địa danh',
		];
	}
}