<?php

use Fsd\Feedbacks\Feedback;
use Fsd\Feedbacks\FeedbackRepository;

class ContactUsController extends BaseController {

	public function __construct(FeedbackRepository $feed) {
		$this->feed = $feed;
		parent::__construct();
	}

	/**
	 * Contact us page.
	 *
	 * @return View
	 */
	public function getIndex() {
		$this->metadata->setTitle('Liên hệ với chúng tôi');
		return View::make('frontend/contact-us');
	}

	/**
	 * Contact us form processing page.
	 *
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
			'fullname'        => 'required',
			'email'       		=> 'required|email',
			'message' 			=> 'required',
		);

		$message = [
			'fullname.required' 	=> 'Vui lòng nhập họ tên',
			'email.required'		=> 'Vui lòng nhập email',
			'email.email'			=> 'Nhập đúng định dạng mail',
			'message.required'   => 'Nhập nội dung'
		];

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules, $message);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails()) {
			return Redirect::route('page/contact')->withErrors($validator);
		}

		$feedback = new Feedback;
		$feedback->feed_fullname = Xss::clean(Input::get('fullname'));
		$feedback->feed_email = Xss::clean(Input::get('email'));
		$feedback->feed_message = Xss::clean(Input::get('message'));
		$feedback->feed_time = time();
		$feedback->feed_status = Feedback::SUBR_DEACTIVE;

		if($feedback->save()) {
			return Redirect::route('page/contact')->withSuccess('Bạn đã gửi nội dung phản hồi đến chúng tôi.');
		}

		return Redirect::route('page/contact')->withErrors($feedback);
	}

}
