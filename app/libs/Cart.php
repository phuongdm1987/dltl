<?php
/**
 * Class Cart
 */
class Cart extends ShoppingCart{


	/**
	 * Get tổng tiền
	 *
	 * @return mixed
	 */
	public function getTotalMoney() {
		$items = $this->_getContents();
		$totalMoney = 0;

		foreach($items as $id => $item) {
			$totalMoney += $item['price'] * $item['quantity'];
		}

		return $totalMoney;
	}

	/**
	 * Lấy thông tin giỏ hàng
	 *
	 * @param  mixed $location - ID khu vực
	 * @return array
	 */
	public function _getContents($location = null) {
		$items = $this->getContents($location);

		$result = array();
		foreach($items as $key => $item) {
			$result[] = array(
				'hash'         => md5($item['options']->pro_id),
				'real_id'      => $item['options']->pro_id,
				'id'           => $item['options']->pro_id,
				'cat_id'       => $item['options']->pro_category_id,
				'name'         => $item['options']->pro_name,
				'price'        => $item['options']->min_price_out,
				'price_format' => format_number($item['options']->min_price_out),
				'quantity'     => $item['quantity'],
				'url'          => '/san-pham/' . $item['options']->pro_id . '/' . removeTitle($item['options']->pro_name),
				'image_sm'     => PATH_IMAGE_PRODUCT . 'sm_' . $item['options']->pro_image,
				'image_md'     => PATH_IMAGE_PRODUCT . 'md_' . $item['options']->pro_image,
				'image_lg'     => PATH_IMAGE_PRODUCT . 'lg_' . $item['options']->pro_image,
				'image'        => PATH_IMAGE_PRODUCT . $item['options']->pro_image
			);
		}

		return $result;
	}


	public function __call($method, $args) {
		if($method == 'contents') {
			return call_user_func_array(array($this, 'getContents'), $args);
		}

		throw new Exception(get_class() . ' with method ' . $method . ' is not exists');
	}
}