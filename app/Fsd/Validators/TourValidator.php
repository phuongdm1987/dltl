<?php namespace Fsd\Validators;

class TourValidator extends AbstractValidator {

	public function rules() {
		return [
		'tou_name'    			=> 'required',
		'tou_price'  			=> 'required',
		'tou_day'   			=> 'required|integer|min:0',
		'tou_night' 			=> 'required|integer|min:0',
		'tou_type' 				=> 'required|integer|min:1',
		'tou_city_departure' => 'required|integer|min:1',
		'tou_vehicle' 			=> 'required'
		];
	}

	public function messages() {
		return [
			'tou_name.required'    				=> 'Vui lòng nhập tên',
			'tou_price.required'  				=> 'Vui lòng nhập giá',
			'tou_day.required'   				=> 'Nhập số ngày đi',
			'tou_day.integer'   					=> 'Vui lòng nhập số nguyên',
			'tou_day.min'   						=> 'Giá trị là số dương',
			'tou_night.required' 				=> 'Nhập số đêm ở',
			'tou_night.integer'   				=> 'Vui lòng nhập số nguyên',
			'tou_night.min'   					=> 'Giá trị là số dương',
			'tou_type.required' 					=> 'Vui lòng chọn loại tour',
			'tou_type.min'                   => 'Vui lòng chọn loại tour',
			'tou_city_departure.required' 	=> 'Chọn điểm xuất phát',
			'tou_vehicle.required' 				=> 'Vui lòng chọn loại phương tiện'
		];
	}
}