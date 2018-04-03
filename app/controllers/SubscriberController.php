<?php

use Fsd\Subscribers\Subscriber;
use Fsd\Subscribers\SubscriberRepository;

class SubscriberController extends BaseController {

	private $subs;

	public function __construct(SubscriberRepository $model)
	{
		$this->subs = $model;
		parent::__construct();
	}

	public function postSubscriber()
	{
		$subscriber = $this->subs->getByEmail(Input::get('subscriber'));

		if ( ! $subscriber) {
			$subs = new Subscriber();
			$subs->sub_email = Input::get('subscriber');
			$subs->sub_time_created = time();
			$subs->sub_time_updated = time();
			$subs->sub_active = Subscriber::SUBR_ACTIVE;

			$data['email'] = $subs->sub_email;
			$data['time']  = date("Y", time());
			if ($subs->save()) {
				return Redirect::back()->with("success", "Bạn đã đăng ký subscriber thành công!");
			}

			return Redirect::back()->withInput()->withErrors($subs->getErrors());
		}

		return Redirect::back()->with("error", "Tài khoản email đã được sử dụng để đăng ký subscriber!");
	}

	/**
	 * Ham bo subcriber
	 * @return
	 */
	public function getUnSubscriber()
	{
		$email = Input::get('email');
		$email = trim($email);
		$update = DB::table('subscribers')->where('sub_email', $email)
				                                      ->update([
				                                          'active' => Subscriber::SUBR_DEACTIVE
				                                       ]);
		if ($update) {
			return Redirect::to("/#form-subscribe")->with("success", "Bạn đã hủy nhận thông tin mới nhất trên Waa.vn!");
		}
	}


	public function unSubscriber()
	{
		$email = Input::get('email');

		if(!$subscriber = $this->subs->getByEmail($email)) {
			return App::abort(404);
		}

		$subscriber->active = Subscriber::SUBR_DEACTIVE;

		if(!$subscriber->save()) {
			return View::make('frontend.subscribers.unsubscriber_success');
		}

		return View::make('frontend.subscribers.unsubscriber_failed');
	}
}
