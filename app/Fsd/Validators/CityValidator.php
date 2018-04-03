<?php namespace Fsd\Validators;

class CityValidator extends AbstractValidator {

   public function rules() {
      return [
         'cit_name'        => 'required'
      ];
   }

   public function messages() {
      return [
         'cit_name.required'  => 'Vui lòng nhập tên tỉnh thành phố'
      ];
   }
}