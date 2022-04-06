<?php namespace Fsd\Posts;

use Fsd\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Post extends Entity implements PresenterInterface {

	protected $primaryKey 	= 'pos_id';
	protected $table 			= "posts";
	public $timestamps 		= false;

	const DRAFT 			= 0;
	const PUBLISHED 		= 1;
	const PUBLISHED_HOT 	= 1;
	const DRAFT_HOT   	= 0;

	const PUBLIC_SITE = 1;
	const DOMAIN_SITE = 0;

	protected $rules = [
		'title'      => 'required'
	];

	protected $messages = [
		'title.required'      => 'Vui lòng nhập tiêu đề'
	];

	public function getUrl() {
		return route('post.detail', [$this->pos_id, removeTitle($this->pos_title)]);
	}

	public function getPicture($prefix = 'sm_') {
		if ($this->pos_image == '' || !file_exists(PATH_UPLOAD_IMAGE_POST . $prefix . $this->pos_image)) return 'https://placehold.it/50x50';
		return PATH_IMAGE_POST . $prefix . $this->pos_image;
	}

	public function category() {
		return $this->belongsTo('Fsd\Categories\Category', 'pos_category_id');
	}

	public function getPresenter() {
		return 'Fsd\Posts\PostPresenter';
	}
}