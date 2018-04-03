<?php
/**
 * Created by PhpStorm.
 * User: daolv
 * Date: 26/03/2015
 * Time: 16:53
 */

namespace Fsd\Validators;


class ChangePasswordValidator extends AbstractValidator{

	public function rules()
	{
		return [
			'password'		=> 'required',
			'repassword' 	=> 'required|same:password'
		];
	}

	public function messages()
	{
		return [
			'password.required'   	=> 'Mật khẩu mới không được bỏ trống',
			'repassword.required'	=> 'Nhập lại mật khẩu không được bỏ trống',
			'repassword.same'			=> 'Mật khẩu không trùng nhau'
		];
	}
}