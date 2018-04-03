<?php namespace Fsd\Tags;

use Fsd\Core\Entity;

class Tag extends Entity {

	protected $rules = [
		"name" => "required|unique:tags,name",
		"slug" => "required",
		"words" => "required"
	];

	public function tours() {
		return $this->belongsToMany('Fsd\Tours\Tour', 'tour_tags', 'tag_id', 'tour_id');
	}
}