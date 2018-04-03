<?php

class HelpController extends BaseController {

	public function getIntroCrawler() {

		$this->metadata->setTitle('Hỗ trợ gim sản phẩm');

		return View::make('frontend.helps.intro_gim');
	}
}