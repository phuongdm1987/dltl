<?php
/**
 * Created by PhpStorm.
 * User: daolv
 * Date: 26/03/2015
 * Time: 15:56
 */

namespace Fsd\Validators;


class ProfileConUpdateValidator extends AbstractValidator {

	public function rules()
	{
		return [
			'fullname'	=> 'required',
			'phone' 		=> 'required'
		];
	}

	public function messages()
	{
		return [
			'fullname.required' 	=> 'Vui lòng nhập tên đầy đủ',
			'phone.required'		=> 'Vui lòng nhập số điện thoại'
		];
	}
}