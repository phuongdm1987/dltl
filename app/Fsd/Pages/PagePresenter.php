<?php namespace Fsd\Pages;

use McCool\LaravelAutoPresenter\BasePresenter;

class PagePresenter extends BasePresenter {

	/**
	 * Return the page's url
	 * @return string
	 */
	public function getUrl() {
		return route('page.view', [$this->pag_id, removeTitle($this->pag_title)]);
	}
}