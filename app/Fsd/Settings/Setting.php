<?php
namespace Fsd\Settings;


use Fsd\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Setting extends Entity {
	protected $primaryKey = 'id';
	public $timestamps = false;
}