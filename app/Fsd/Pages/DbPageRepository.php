<?php
namespace Fsd\Pages;

use Fsd\Core\EloquentRepository;

class DbPageRepository extends EloquentRepository implements PageRepository {

	public function __construct(Page $model) {
		$this->model = $model;
	}

	public function getAllPageByPaginate($count = 25){
		return $this->model->orderBy('pag_id', 'DESC')->paginate($count);
	}

	public function getPageById($id) {
		return $this->model->find($id);
	}

	public function getPageByType($type = 0, $count = 25) {
		return $this->model->where('pag_active', Page::PAGE_ACTIVE)
						->where('pag_type', $type)
						->paginate($count);
	}

	public function getPageByPosition($position = 0, $type = 0, $top = 5) {
		return $this->model->where('pag_type', $type)
					 ->where('pag_active', Page::PAGE_ACTIVE)
					 ->where(function($q) use ($position) {
							if ($position != 0) {
								$q->where('pag_position', $position);
							}
						})
						->orderBy('pag_create_time', 'DESC')
						->take($top)->get();
	}

	public function getRelatedPagePublic($count = 25) {
		return $this->model->where('pag_type', Page::PAGE_SITE_TYPE)
								 ->where('pag_active', Page::PAGE_ACTIVE)
								 ->orderBy('pag_create_time', 'DESC')
								 ->take($count)->get();
	}

	public function getAllPagePublicSite() {
		return $this->model->where('pag_type', Page::PAGE_SITE_TYPE)
								 ->where('pag_active', Page::PAGE_ACTIVE)
								 ->orderBy('pag_create_time', 'DESC')
								 ->get();
	}
}