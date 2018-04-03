<?php namespace Fsd\Tags;

use Fsd\Tags\Tag;
use Fsd\Tags\TagRepository;
use DB;
class DbTagRepository implements TagRepository {

	protected $tag;

	public function __construct(Tag $tag) {
		$this->tag = $tag;
	}

	public function getAllPaginated($count)
	{
		// TODO: Implement getAllPaginated() method.
		return $this->tag->paginate($count);
	}

	public function getAll()
	{
		// TODO: Implement getAll() method.
		return $this->tag->all();
	}

	public function getTagBySlug($slug)
	{
		// TODO: Implement getTagBySlug() method.
		$tag = $this->tag->where('slug', $slug)->first();

		return $tag;
	}

	public function getTagById($id)
	{
		// TODO: Implement getTagById() method.
		return $this->tag->find($id);
	}

	public function searchTag($query)
	{
		// TODO: Implement searchTag() method.
		return $this->tag->where('slug', 'LIKE', "%$query%")->take(5)->get();
	}

	public function getTagByName($name) {
		// TODO: Implement getTagBySlug() method.
		$tag = $this->tag->where('name', $name)->first();

		return $tag;
	}
}