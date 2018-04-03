<?php namespace Fsd\Categories;

use \Helper;
use Fsd\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Category extends Entity implements PresenterInterface {

	public $table = 'categories';
	public $parent_id = array();
	public $sorted_nodes = array();

	const ACTIVE 	= 1;
	const DEACTIVE = 0;

	protected $rules = [
		'name' => 'required',
		'type' => 'required|integer|min:1'
	];

	protected $messages = [
		'name.required' => 'Bạn chưa nhập tên danh mục',
		'type.min'      => 'Bạn chưa chọn loại danh mục'
	];

	/**
	 * Url to category page
	 * @return string
	 */
	public function url() {
		return "/danh-muc/" . $this->id . "-" . Helper::removeTitle($this->name);
	}

	public function getUrlBlog() {
		return route('post.list', [$this->id, removeTitle($this->name)]);
	}

	public function getPresenter() {
		return 'Fsd\Categories\CategoryPresenter';
	}
}