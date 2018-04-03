<?php

class FunctionsTest extends TestCase {

	public function test_removeTitle() {
		$this->assertEquals(removeTitle('Lương văn công'), 'luong-van-cong');
	}

	public function test_removeAccent() {
		$this->assertEquals(removeAccent('Lương văn công'), 'Luong van cong');
	}

	public function test_dateToInteger() {
		$string = '24/10/1990';
		$time = strtotime(str_replace('/', '-', $string));
		$this->assertEquals(dateToInteger($string), $time);
	}

	public function test_makeOrderCode() {
		$orderId = 100;
		$output = 'WAA-' . $orderId . '-' . time();

		$this->assertEquals(makeOrderCode($orderId), $output);
	}

	public function test_makePrice() {
		$price = 245000;
		$output = roundPrice(($price + $price * 0.08) * 3490);

		$this->assertEquals(makePrice($price), $output);
	}

	public function test_isProductSaleOnline() {
		$this->assertTrue(isProductSaleOnline(PRODUCT_TYPE_PRODUCT));
		$this->assertTrue(isProductSaleOnline(PRODUCT_TYPE_CRAWLER_TAOBAO));
		$this->assertTrue(isProductSaleOnline(PRODUCT_TYPE_USER));
	}

	public function test_isProductCanEdit() {
		$this->assertTrue(isProductCanEdit(PRODUCT_TYPE_USER));
		$this->assertTrue(isProductCanEdit(PRODUCT_TYPE_COLLECTION));
	}

	public function test_getAllboards() {
		$boards = getAllBoards(['limit' => false, 'active' => false]);
		// print_r($boards->toArray());
	}

}