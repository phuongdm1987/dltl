<?php
namespace Controllers\Api;

use Fsd\Categories\CategoryRepository;
use BaseController;
use Input;

class CategoryController extends \Controller {
	public function __construct(CategoryRepository $category) {
		$this->category = $category;
	}

	public function getAllCategories()
	{
		return $this->category->getListChilds(0);
	}

	public function getCategoriesLevel0() {
		return $this->category->getCategoriesByLevel(0);
	}

	public function getById($id) {
		return $this->category->getById($id);
	}

	public function getAllChilds() {
		$parentId = (int) Input::get('parent_id');

		$categories = $this->category->getListChilds($parentId);

		$results = [];

		foreach($categories as $category) {
			if($category->level == 0) {
				$results[] = $category;
			}
		}

		return $results;
	}

}