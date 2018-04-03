<?php namespace Fsd\Categories;

use Fsd\Categories\Category;
use Fsd\Categories\CategoryRepository;

class DbCategoryRepository implements CategoryRepository {

	public $sorted_nodes;
	private $category;
	private $parent_id;

	public function __construct(Category $category) {
		$this->category = $category;
	}

	public function getById($id) {
		return $this->category->find($id);
	}

	/**
	 * Get all categories
	 * @return Category collection
	 */
	public function getAll() {
		$categories = $this->category->where('active', 1)->get();
		$sorted_categories = array();

		foreach ($categories as $category) {
			$sorted_categories[$category->parents][$category->id] = $category;
		}

		$this->sort($sorted_categories);
		return $this->sorted_nodes;
	}

	/**
	 * Sort categories
	 * @param int $parent ID nut cha
	 */
	public function getListChilds($parent = 0, $options = array()) {

		// Reset nodes
		$this->sorted_nodes = array();
		$categories = array();

		// Where condition clause
		$filter = '1 AND active = 1 ';
		if (isset($options['where'])) {
			$filter .= $options['where'];
		}

		// Order condition clause
		$order = isset($options['order']) ? $options['order'] : 'name ASC, id DESC';
		$filterdCategories = $this->category->whereRaw($filter)->orderByRaw($order)->get();

		foreach($filterdCategories as $category) {
			$categories[$category->parents][$category->id] = $category;
		}

		$this->sort($categories, $parent);
		return $this->sorted_nodes;
	}

	/**
	 * Get parent of category
	 * @param  int $cid Child ID
	 * @return Category
	 */
	public function getParent($cid) {
		$category = $this->getById($cid);
		return $this->category->where('id', $category->parents)->first();
	}

	/**
	 * Sorting all category by hierachy and leveling them
	 * @param  array  $categories 	All sorted category
	 * @param  integer $parent     	We start with this
	 * @param  integer $level      	Leveling
	 * @return Category collection
	 */
	public function sort($categories, $parent = 0, $level = -1) {
		if (array_key_exists($parent, $categories)) {
			$level++;
			foreach($categories[$parent] as $key => $category) {
				$category['level'] = $level;
				$this->sorted_nodes[] = $category;
				$this->sort($categories, $key, $level);
			}
		}
	}

	/**
	 * Get array categories
	 * @return array
	 */
	public function getCategoriesArray() {
		$newCategories = array();
		$categories	= $this->category->orderBy('id')->get();

		foreach ($categories as $category) {
			$newCategories[$category->id] = $category;
		}

		return $newCategories;
	}

	/**
	 * Get categories by level
	 * @param  integer $level
	 * @return array
	 */
	public function getCategoriesByLevel($level = 0) {

		$newCategories = array();
		$categories = $this->getListChilds();

		foreach ($categories as $category) {
			if ($category->level == $level) {
				$newCategories[] = $category;
			}
		}

		return $newCategories;
	}

	/**
	 * Get list ID parents
	 * @param  integer 	$child_id
	 * @param  array 		$categories
	 * @return array
	 */
	public function getListParents($child_id, $categories, $isObject = false) {
		$this->parent_id = [];
		$pid = (int) isset($categories[$child_id]['parents']) ? $categories[$child_id]['parents'] : 0;
		if ($pid > 0) {
			$this->getListParents($pid, $categories, $isObject);
			if (!$isObject) {
				$this->parent_id[] = $pid;
			} else {
				$this->parent_id[] = $categories[$pid];
			}
		}

		return $this->parent_id;
	}


}