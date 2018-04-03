<?php namespace Fsd\Contacts;

use Fsd\Core\EloquentRepository;

class DbContactRepository extends EloquentRepository implements ContactRepository {

	public function __construct(Contact $model) {
		$this->model = $model;
	}
}