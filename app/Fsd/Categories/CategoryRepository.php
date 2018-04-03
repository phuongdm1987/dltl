<?php namespace Fsd\Categories;

interface CategoryRepository {
	public function getAll();
	public function getById($id);
	public function getListChilds($pid = 0, $options = array());
	public function getParent($cid);
	/**
	 * Get list ID parents
	 * @param  integer 	$child_id
	 * @param  array 		$categories
	 * @return array
	 */
	public function getListParents($child_id, $categories, $isObject = false);

	/**
	 * Get array categories
	 * @return array
	 */
	public function getCategoriesArray();

	public function getCategoriesByLevel($level);
}