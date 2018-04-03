<?php
namespace Fsd\Subscribers;

interface SubscriberRepository {
	public function getByEmail($email);
	public function getAllPaginated($count, $status);
	public function getAll($count = 25);
}