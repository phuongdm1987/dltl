<?php

use Packages\Repositories\PostRepository as PostRepository;

class PostRepositoryTest extends TestCase {

	public function setUp() {
		parent::setup();

		$this->postMock = Mockery::mock('Post');
		$eventMock = Mockery::mock('Illuminate\Events\Dispatcher');
		$loginMock = Mockery::mock('Login');

		$this->postRepo = new PostRepository($eventMock, $this->postMock, $loginMock);
	}

	public function tearDown()
	{
		$this->postMock = null;
		$this->postRepo = null;
	}

	public function test_all() {
		$this->postMock->shouldReceive('all')->once()->andReturn(array());
		// $this->assertEquals($this->postRepo->all(), array());
	}

	public function test_Create() {

		$this->postMock->shouldReceive('insertGetId')->once()->andReturn(1);
		$this->assertEquals($this->postRepo->create(['title' => 'test']), 1);
	}

	public function test_Update()
	{
		$this->postMock
		               ->shouldReceive('fill')->once()->andReturn($this->postMock)
		               ->shouldReceive('save')->once()->andReturn(true);

		// $this->assertEquals($this->postRepo->update(1, ['title' => 'cong']), true);
	}

	public function test_Map()
	{
		$postRepo = App::make('Packages\Repositories\PostRepository');
		// print_r($postRepo->exchangeData(['title' => 'test', 'id' => '1']));
	}
}