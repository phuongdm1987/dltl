<?php
namespace Fsd\Subscribers;


use Fsd\Subscribers\Subscriber;
use Fsd\Subscribers\SubscriberRepository;

class DbSubscriberRepository implements SubscriberRepository {

	private $model;

	/**
	 * @param Subscriber $model
	 */
	public function __construct(Subscriber $model)
	{
		$this->model = $model;
	}

	public function getByEmail($email)
	{
		// TODO: Implement getByEmail() method.
		return $this->model->where('sub_email', $email)->first();
	}

	public function getAllPaginated($count, $status = Subscriber::SUBR_ACTIVE)
	{
		// TODO: Implement getAllPaginated() method.
		return $this->model->where('sub_active', $status)->paginate($count);
	}

	public function getAll($count = 25)
	{
		// TODO: Implement getAll() method.
		return $this->model->orderBy('sub_id', 'DESC')->paginate($count);
	}
}