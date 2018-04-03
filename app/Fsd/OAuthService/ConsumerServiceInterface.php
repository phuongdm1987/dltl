<?php namespace Fsd\OAuthService;

interface ConsumerServiceInterface
{
	public function getConsumer();
	public function getTypeSignup();
	public function getRequest();
	public function getKeyResult();
}