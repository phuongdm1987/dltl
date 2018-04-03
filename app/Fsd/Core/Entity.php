<?php namespace Fsd\Core;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Fsd\Core\Exceptions\NoValidationRulesFoundException;
use Fsd\Core\Exceptions\NoValidatorInstantiatedException;

abstract class Entity extends Model {

}