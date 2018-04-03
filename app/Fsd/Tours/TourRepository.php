<?php namespace Fsd\Tours;

use Fsd\Tours\Tour;

use Fsd\Users\User;
use Fsd\Places\Place;

interface TourRepository {
	public function getToursByPaginated(array $params, $count = 25, $status = Tour::STATUS_CONFIRM);
	public function getTourById($id);
	public function getPublishToursPaginated($count = 10);
	public function getPublishToursByTypePaginated($type, $count = 10);
	// public function filterTours(array $params, $limit = 10);
	public function getToursPaginatedByUser(User $user, $count = 10, $where = null, $sort = null);
	public function getToursByDestinationPaginated(Place $place, $count = 10);
	public function saveImages(Tour $tour, array $data);
	public function saveContent(Tour $tour, array $data);
	public function removePhotoTour($id = 0);
	public function searchToursByKeyword($q, $count = 10);
	public function searchToursByParams(array $params, $count = 10);
	public function getTourPaginateByUserId(array $params, $user_id, $count = 25);
	public function getAllPhotoByTourId(Tour $tour);
	public function getTourContent(Tour $tour);
	public function getTourByPlace($placeId, $count = 10);
	public function getTourByUser(User $user, $count = 10, array $param = array());
}