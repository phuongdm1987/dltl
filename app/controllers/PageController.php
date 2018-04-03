<?php
use Fsd\Pages\Page;
use Fsd\Pages\PageRepository;
use Fsd\Core\Exceptions\EntityNotFoundException;

class PageController extends BaseController {

	public function __construct(PageRepository $page) {
		$this->page = $page;
		parent::__construct();
	}

	public function getPageDetail($pageId, $pageTitle) {

		$page = $this->page->getPageById($pageId);

		// Check if the blog post exists
		if (is_null($page)) {
			throw new EntityNotFoundException('Không tìm thấy tài nguyên trong ' . get_called_class(), 404);
		}

		// Redirect 301
		if(removeTitle($page->pag_title) != $pageTitle) {
			header("HTTP/1.1 301 Moved Permanently");
			header( "Location:  ". route('page.view', [$page->pag_id, removeTitle($page->pag_title)]));
			exit;
		}

		// Metadata
		//
		$desc = Str::words(strip_tags($page->pag_content), 30);
		$desc = str_replace("\n", " ", $desc);
		$desc = str_replace("  ", "", $desc);

		$this->metadata->setTitle($page->pag_title);
		$this->metadata->setDescription($desc);

		$relatedPage = $this->page->getRelatedPagePublic();

		$this->metadata->setTitle('Giới thiệu về chúng tôi');

		return View::make('frontend/pages/detail', compact('page', 'relatedPage'));
	}

	/*
	* Contact
	*/
	public function getContactUs() {
		$this->metadata->setTitle('Liên hệ với chúng tôi');
		return View::make('frontend/pages/contact');
	}
}