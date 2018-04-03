<?php
namespace Fsd\Pages;
use Fsd\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Page extends Entity implements PresenterInterface{

	protected $primaryKey = 'pag_id';
	protected $table      = "pages";
	public $timestamps    = false;

	/**
	 * PAGE_SITE_TYPE = 1 Page cho trong chủ waa.vn
	 *	PAGE_DOMAIN_TYPE = 2 Page cho các cửa hàng, hoặc chi nhánh
	 */
	const PAGE_SITE_TYPE 	= 1;
	const PAGE_DOMAIN_TYPE 	= 2;

	const PAGE_ACTIVE 	= 1;
	const PAGE_DEACTIVE 	= 0;

	protected $rules = [
		'title'      => 'required'
	];

	protected $messages = [
		'title.required'      => 'Vui lòng nhập tiêu đề'
	];

	public function getUrl() {
		return route('page.view', [$this->pag_id, removeTitle($this->pag_title)]);
	}

	public function parent() {
        return $this->hasOne('pages', 'pag_id', 'pag_parent');
    }

	public function children() {
		return $this->hasMany('pages', 'pag_parent', 'pag_id');
	}

	public function getPresenter() {
		return 'Fsd\Pages\PagePresenter';
	}
}