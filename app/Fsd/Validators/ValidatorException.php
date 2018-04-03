<?php namespace Fsd\Validators;

use Exception;
use Illuminate\Support\MessageBag as MessageBag;

class ValidatorException extends Exception {

	protected $errors;

	public function __construct($message, MessageBag $error) {
		$this->errors = $error;

		parent::__construct($message, 0);
	}

	public function getErrors() {
		return $this->errors;
	}
}