<?php namespace Fsd\Settings;

use Fsd\Domains\Domain;

use Fsd\Core\EloquentRepository;

class DbSettingRepository extends EloquentRepository implements SettingRepository {

	public function __construct(Setting $setting) {
		$this->model = $setting;
	}
}