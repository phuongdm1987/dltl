<?php
namespace Fsd\Pages;

interface PageRepository {
	public function getAllPageByPaginate($count = 25);
	public function getPageById($pageId);
	public function getPageByType($type = 0, $count = 25);
	public function getPageByPosition($position = 0, $type = 0, $top = 5);
	public function getRelatedPagePublic($count = 25);
	public function getAllPagePublicSite();
}