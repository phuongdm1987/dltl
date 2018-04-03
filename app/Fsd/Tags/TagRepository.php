<?php
/**
 * User: alvintran
 * Date: 2/25/15
 * Time: 10:39 PM
 */

namespace Fsd\Tags;


interface TagRepository {
	public function getAllPaginated($count);
	public function getAll();
	public function getTagBySlug($slug);
	public function getTagById($id);
	public function searchTag($query);
	//public function getTagCountArticles($count = 20);
	public function getTagByName($name);
}