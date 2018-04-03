<?php namespace Fsd\Feedbacks;


use Fsd\Feedbacks\Feedback;
use Fsd\Feedbacks\FeedbackRepository;

class DbFeedbackRepository implements FeedbackRepository {

	private $model;

	/**
	 * @param Subscriber $model
	 */
	public function __construct(Feedback $model)
	{
		$this->model = $model;
	}

	public function getAllFeedback($count = 25) {
		return $this->model->orderBy('feed_time', 'DESC')->paginate($count);
	}
}