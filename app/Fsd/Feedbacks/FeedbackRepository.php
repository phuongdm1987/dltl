<?php namespace Fsd\Feedbacks;


interface FeedbackRepository {
	public function getAllFeedback($count = 25);
}