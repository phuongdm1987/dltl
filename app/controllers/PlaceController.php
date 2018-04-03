<?php
use Fsd\Tours\Tour;
use Fsd\Tours\TourRepository;

use Fsd\Places\Place;
use Fsd\Places\PlaceRepository;

class PlaceController extends BaseController {

	public function __construct(TourRepository $tour, PlaceRepository $place) {
		$this->tour  = $tour;
		$this->place = $place;
		parent::__construct();
	}

	public function getIndex($placeId, $placeSlug) {
		if(!$place = $this->place->getById($placeId)) {
			return \App::abort(404);
		}

		$this->metadata->setTitle('Tour du lịch ' . $place->pla_name . ' giá tốt nhất');
		$this->metadata->setDescription('Tour du lịch '. $place->pla_name .' cực lý tưởng cho bạn. Cam kết giá rẻ. Đội ngũ nhân viên tư vấn nhiều kinh nghiệm. Thanh toán dễ dàng đa dạng');

		$tours = $this->tour->getToursByDestinationPaginated($place, 10);

		return View::make('frontend.places.tours', compact('place', 'tours'));
	}
}