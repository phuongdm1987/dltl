<?php
use Fsd\Stores\DbStoreRepository;

class StoreRepositoryTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
		$dbMock = Mockery::mock('Illuminate\Database\DatabaseManager');
		$modelMock = Mockery::mock('Fsd\Stores\Store');

		$this->storeRepo = new DbStoreRepository($modelMock, $dbMock);
	}

	public function testGetProductIdsByStoreId()
	{
		print_r($this->storeRepo->getAllProductIdsByStoreId(10));
	}
}