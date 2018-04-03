<?php namespace Fsd\OAuthService;

class FacebookService implements ConsumerServiceInterface
{
	protected $consumer   = FACEBOOK;
	protected $typeSignup = FACEBOOK_SIGNUP;
	protected $request    = 'me';
	protected $keyResult  = 'email';

	public function getConsumer()
	{
		return $this->consumer;
	}
	public function getTypeSignup()
	{
		return $this->typeSignup;
	}
	public function getRequest()
	{
		return $this->request;
	}
	public function getKeyResult()
	{
		return $this->keyResult;
	}
}

