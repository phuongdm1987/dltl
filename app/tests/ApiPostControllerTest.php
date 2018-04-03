<?php
use Packages\Repositories\PostRepository as PostRepository;
class ApiPostControllerTest extends TestCase {
	public function testIndex()
	{
		$userMock = Mockery::mock('User');
		// $userMock->shouldReceive('setAttribute');
		$userMock->shouldReceive('getAttribute')->andReturn(Mockery::self());

		$postMock = Mockery::mock('Post');
		$eventMock = Mockery::mock('Illuminate\Events\Dispatcher');
		$loginMock = Mockery::mock('Login');

		$postRepo = new PostRepository($eventMock, $postMock, $loginMock);


	}
}