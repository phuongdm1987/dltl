<?php namespace Controllers\Api;

use Fsd\Tags\TagRepository;
use Fsd\Places\PlaceRepository;
use BaseController;
use Response, Input;

class TagController extends BaseController {

	public function __construct(TagRepository $mTag, PlaceRepository $mPlace) {

		parent::__construct();

		$this->mTag = $mTag;
		$this->mPlace = $mPlace;
	}

	/**
	* Get suggest tag
	* @return string json
	*/
	public function getSuggestTag() {
		$response = [];
		$query = removeTitle(Input::get('term'));
		$tags = $this->mTag->searchTag($query);
		foreach($tags as $tag) {
			$tmp['label'] = $tag->name;
			$tmp['value'] = $tag->name;
			$response[] = $tmp;
		}
		return json_encode($response);
	}

	/**
	* Get suggest places
	* @return string json
	*/
	public function getSuggestPlace() {
		$response = [];
		$query = removeTitle(Input::get('term'));
		$places = $this->mPlace->searchPlace($query);
		foreach($places as $place) {
			$tmp['label'] = $place->pla_name;
			$tmp['value'] = $place->pla_name;
			$response[] = $tmp;
		}
		return json_encode($response);
	}
}