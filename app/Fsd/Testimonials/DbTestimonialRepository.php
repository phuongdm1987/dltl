<?php namespace Fsd\Testimonials;

use Fsd\Core\EloquentRepository;
use Fsd\Domains\Domain;

class DbTestimonialRepository extends EloquentRepository implements TestimonialRepository {

	public function __construct(Testimonial $model) {
		$this->model = $model;
	}

}