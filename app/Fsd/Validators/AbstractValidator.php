<?php namespace Fsd\Validators;

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Validator;
use Fsd\Validatiors\ValidatorException as ValidatorException;

abstract class AbstractValidator {

	/**
	* @var Validator
	*/
	protected $validation;

	/**
	* @var \Illuminate\Validation\Factory
	*/
   public $validator;

	/**
	* @param \Illuminate\Validation\Factory $validator
	*/
   public function __construct(ValidatorFactory $validator)
   {
      $this->validator = $validator;
   }

	/**
	* @param array $formData
	*
	* @throws FormValidationException
	*/
   public function validate(array $formData, $throwException = true)
   {
      // Instantiate validator instance by factory
      $this->validation = $this->validator->make($formData, $this->rules(), $this->messages());

      // Validate
      if ($this->validation->fails()) {
         if($throwException) {
            throw new ValidatorException('Validation Failed', $this->getErrors());
         }
         else {
            return false;
         }

      }

      return true;
   }

   /**
   * @return MessageBag
   */
   public function getErrors() {
      return $this->validation->errors();
   }

   public function toHtml()
   {
      $errors = $this->getErrors()->toArray();
      $arrayError = [];
      foreach($errors as $error) {
         foreach($error as $e) {
            $arrayError[] = '<div>'. $e .'</div>';
         }
      }
      return implode('', $arrayError);
   }

   /**
   * @return array
   */
   abstract protected function rules();

   abstract protected function messages();

}