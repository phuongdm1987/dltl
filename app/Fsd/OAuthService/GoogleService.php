<?php namespace Fsd\OAuthService;

class GoogleService implements ConsumerServiceInterface
{
	protected $consumer   = GOOGLE;
	protected $typeSignup = GOOGLE_SIGNUP;
	protected $request    = 'https://www.googleapis.com/oauth2/v1/userinfo';
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

