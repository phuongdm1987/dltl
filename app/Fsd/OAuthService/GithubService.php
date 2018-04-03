<?php namespace Fsd\OAuthService;

class GithubService implements ConsumerServiceInterface
{
	protected $consumer   = GITHUB;
	protected $typeSignup = GITHUB_SIGNUP;
	protected $request    = 'user/emails';
	protected $keyResult  = 0;

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

