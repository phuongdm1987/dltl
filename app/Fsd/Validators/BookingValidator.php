<?php
namespace Fsd\Validators;

class BookingValidator extends AbstractValidator 
{
   public function rules() {
      return [
      'name'    => 'required',
      'phone'   => 'required',
      'email'   => 'required|email',
      'address' => 'required'
      ];
   }

   public function messages() {
      return [
         'name.required'    => 'Vui lòng nhập tên',
         'phone.required'   => 'Vui lòng nhập số ĐT',
         'email.required'   => 'Vui lòng nhập Email',
         'email.email'      => 'Email không đúng định dạng',
         'address.required' => 'Vui lòng nhập số địa chỉ'
      ];
   }
}
?>