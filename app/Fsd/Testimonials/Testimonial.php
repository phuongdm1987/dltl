<?php namespace Fsd\Testimonials;

use Fsd\Core\Entity;
use McCool\LaravelAutoPresenter\PresenterInterface;

class Testimonial extends Entity implements PresenterInterface {

	protected $table        = 'testimonials';
	protected $primaryKey   = 'tes_id';

	const DRAFT 		= 0;
	const PUBLISHED 	= 1;

	const PUBLIC_SITE = 1;
	const DOMAIN_SITE = 0;

	public function getPicture($type = 'sm_') {
		return $this->tes_image != null ?
				PATH_IMAGE_TESTIMONTIAL . $type . $this->tes_image
				: 'http://placehold.it/50x50';
	}

	public function getPresenter() {
		return 'Fsd\Testimonials\TestimonialPresenter';
	}

}