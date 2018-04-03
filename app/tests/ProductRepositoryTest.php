<?php
use Packages\Repositories\ProductRepository as ProductRepository;

class ProductRepositoryTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		$this->eventMock = Mockery::mock('Illuminate\Events\Dispatcher');
		$this->productMock = Mockery::mock('Products');
		$this->loginMock = Mockery::mock('Login');
		$this->productStoreMock = Mockery::mock('ProductStore');
		$this->productImageMock = Mockery::mock('ProductImages');

		$this->productRepository = new ProductRepository($this->eventMock, $this->productMock, $this->loginMock, $this->productStoreMock, $this->productImageMock);
	}

	public function tearDown()
	{
		Mockery::close();
	}

	public function testFind()
	{
		$this->productMock->shouldReceive('find')->with('foo')
		                  ->once()
		                  ->andReturn('bar');

		$this->assertEquals('bar', $this->productRepository->find('foo'));
	}

	public function testGetProductXuatNhapTon()
	{

		$this->productMock->shouldReceive('select->join->join->where->where->where->groupBy->orderBy->paginate')
		                  ->andReturn('bar');

		$this->assertEquals('bar', $this->productRepository->getProductXuatNhapTon(25));
	}

}