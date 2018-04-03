<?php
/**
 * Class pagination
 * @author Cong Luong <cong.itsoft@gmail.com>
 * Last edit 28/08/2014
 * @version 1.0
 */
class Pagination {

	public $_args = null;


	/**
	 * Kiểu hiện thị
	 * @var string
	 */
	private $layout = 'number';

	/**
	 * Tổng số record
	 * @var integer
	 */
	private $total_record = null;

	/**
	 * Tổng số link
	 * @var integer
	 */
	private $total_links = null;

	/**
	 * Giới hạn record trên 1 trang
	 * @var integer
	 */
	private $limit_record = null;


	/**
	 * Số link muốn hiển thị
	 * @var integer
	 */
	private $display_links = 10;


	/**
	 * Param truyền lên url
	 * @var string
	 */
	private $query_string = 'page';

	/**
	 * Thẻ mở
	 * @var string
	 */
	private $tag_link_before = '<li>';


	/**
	 * Thẻ đóng
	 * @var string
	 */
	private $tag_link_after = '</li>';


	/**
	 * Thẻ bao lấy toàn bộ link
	 * @var string
	 */
	private $tag_link_wrapper_before = '<ul class="pagination">';


	/**
	 * Thẻ đóng toàn bộ link
	 * @var string
	 */
	private $tag_link_wrapper_after = '</ul>';


	/**
	 * Thẻ mở của link hiện tại
	 * @var string
	 */
	private $tag_link_current_before = '<li class="active">';


	/**
	 * Thẻ đóng của link hiện tại
	 * @var string
	 */
	private $tag_link_current_after = '</li>';


	/**
	 * Thẻ mở link disable ( Dùng trong layout basic )
	 * @var string
	 */
	private $tag_link_disabled_before = '<li class="disabled">';


	/**
	 * Thẻ đóng link disable ( Dùng trong layout basic )
	 * @var string
	 */
	private $tag_link_disabled_after = '</li>';


	/**
	 * Text prev
	 * @var string
	 */
	private $text_prev = '&lsaquo;';


	/**
	 * Text next
	 * @var string
	 */
	private $text_next = '&rsaquo;';


	/**
	 * Text last link
	 * @var string
	 */
	private $text_last = '&raquo;';


	/**
	 * Text first link
	 * @var string
	 */
	private $text_first = '&laquo;';


	/**
	 * Constructor
	 * @param array $config [description]
	 * $config['total_record'] required
	 * $config['limit_record'] required
	 * $config['display_links'] optional
	 * $config['tag_link_before'] optional
	 * $config['tag_link_after'] optional
	 * $config['tag_link_wrapper_before'] optional
	 * $config['tag_link_wrapper_after'] optional
	 * $config['tag_link_current_before'] optional
	 * $config['tag_link_current_after'] optional
	 * $config['tag_link_disabled_before'] optional
	 * $config['tag_link_disabled_after'] optional
	 * $config['text_prev'] optiontal
	 * $config['text_next'] optional
	 * $config['layout'] basic | number - default number
	 */
	public function __construct(array $config = array()) {
		$this->set_config_options($config);
	}

	/**
	 * Tạo link phân trang
	 * @return string
	 */
	public function paginate_links() {

		// Kiểm tra dữ liệu đầu vào
		$this->validate_input_value();

		$links = '';

		// Tổng số trang
		$num_page = ceil($this->total_record / $this->limit_record);

		// Nếu tổng số trang = 1 thì return luôn
		if($num_page <= 1) return null;

		// Xác định trang hiện tại
		$current_page = $this->get_current_page();

		// Nếu số link muốn hiển thị > tổng số trang thì bằng tổng số trang luôn
		$display_links = $this->display_links > $num_page ? $num_page : $this->display_links;

		// Nếu trang hiện tại > tổng số trang thì trang hiện tại bằng tổng số trang
		$current_page = $current_page > $num_page ? $num_page : $current_page;

		// Tính toán để trang hiện tại nằm ở giữa
		$mid = ceil($display_links / 2);

		// Vị tri bắt đầu vòng lặp
		$range_start  = $current_page - $mid > 0 ? $current_page - $mid : 1;

		// Vị trí kết thúc vòng lặp
		$range_end    = ($current_page + $mid) < $display_links ? $display_links : $current_page + $mid;
		$range_end    = $range_end > $num_page ? $num_page : $range_end;

		if($this->layout == 'number') {

			// Thẻ mở ul
			$links .= $this->tag_link_wrapper_before . $this->get_first_link();

			// Nút prev -next
			$link_prev = $link_next = '';
			if($current_page > 1 ) {
				$link_prev .= $this->tag_link_before . '<a href="'. $this->create_query_string($current_page - 1) .'">'. $this->text_prev .'</a>' . $this->tag_link_after;
			}

			if($current_page < $num_page) {
				$link_next = $this->tag_link_before . '<a href="'. $this->create_query_string($current_page + 1) .'">'. $this->text_next .'</a>' . $this->tag_link_after;
			}

			$links .= $link_prev;

			// Lặp và in ra số link phân trang
			for($i = $range_start; $i <=  $range_end; $i ++) {
				if($current_page == $i) {
					$links .= $this->tag_link_current_before . '<a href="javascript:;">'. $i .'</a>' . $this->tag_link_current_after;
				} else {
					$links .= $this->tag_link_before . '<a href="'.$this->create_query_string($i).'">' . $i ."</a>" . $this->tag_link_after;
				}
			}

			// Một số link khác
			if($range_end < $num_page) {
				if($range_end + 5 < $num_page && $range_end + 10 <= $num_page) {
					$links .= $this->tag_link_before . '<a href="javascript:;">...</a>' . $this->tag_link_after;
					for($i = $range_end + 5; $i < $range_end + 10 ; $i ++) {
						$links .= $this->tag_link_before . '<a href="'. $this->create_query_string($i) .'">'. $i .'</a>' . $this->tag_link_after;
					}
				}
			}

			$links .= $link_next;

			// Thẻ đóng ul
			$links .= $this->get_last_link() . $this->tag_link_wrapper_after;

		} else if( $this->layout == 'basic' ) {
			$href_prev = ($current_page > 1) ? $this->create_query_string($current_page - 1) : $this->create_query_string(1);
			$href_next = ($current_page < $num_page) ? $this->create_query_string($current_page + 1) : $this->create_query_string($num_page);

			$links = $this->tag_link_wrapper_before . $this->get_first_link();

			if($current_page == 1) {
				$links .= $this->tag_link_disabled_before . '<a href="javascript:;">'. $this->text_prev .'</a>' . $this->tag_link_disabled_after;
			} else {
				$links .= $this->tag_link_before . '<a href="'. $href_prev .'">'. $this->text_prev .'</a>' . $this->tag_link_after;
			}

			if($current_page == $num_page) {
				$links .= $this->tag_link_disabled_before . '<a href="javascript:;">'. $this->text_next .'</a>' . $this->tag_link_disabled_after;
			}  else {
				$links .= $this->tag_link_before . '<a href="'. $href_next .'">'. $this->text_next .'</a>' . $this->tag_link_after;
			}

			$links .= $this->get_last_link() . $this->tag_link_wrapper_after ;

		}

		return $links;
	}

	public function get_prev_link() {
		if($this->prev_page) {
			return $this->tag_link_before . '<a href="'. $this->create_query_string($this->prev_page) .'">'. $this->text_prev .'</a>' . $this->tag_link_after;
		}
		return null;
	}

	public function get_next_link() {
		if($this->next_page) {
			return $this->tag_link_before . '<a href="'. $this->create_query_string($this->next_page) .'">'. $this->text_next .'</a>' . $this->tag_link_after;
		}

		return null;
	}

	public function get_first_link() {
		if($this->get_current_page() > 1) {
			return $this->tag_link_before . '<a href="'. $this->create_query_string(1) .'">'. $this->text_first .'</a>' . $this->tag_link_after;
		}

		return null;
	}

	public function get_last_link() {
		if($this->get_current_page() < $this->total_links) {
			return $this->tag_link_before . '<a href="'. $this->create_query_string($this->total_links) .'">'. $this->text_last .'</a>' . $this->tag_link_after;
		}

		return null;
	}

	/**
	 * Kiểm tra dữ liệu đầu vào
	 * @return exception
	 */
	private function validate_input_value() {
		if(is_null($this->total_record)) {
			throw new PaginationException(PaginationException::REQUIRE_TOTAL_RECORD);
		}

		if(!is_integer($this->total_record)) {
			throw new PaginationException(PaginationException::TYPE_ERROR_TOTAL_RECORD);
		}

		if(is_null($this->limit_record)) {
			throw new PaginationException(PaginationException::REQUIRE_LIMIT_RECORD);
		}

		if(!is_integer($this->limit_record)) {
			throw new PaginationException(PaginationException::TYPE_ERROR_LIMIT_RECORD);
		}
	}


	/**
	 * Set config options
	 * @param void
	 */
	private function set_config_options($config) {
		if(isset($config['tag_link_before'])) $this->set_tag_link_before($config['tag_link_before']);
		if(isset($config['tag_link_after'])) $this->set_tag_link_after($config['tag_link_after']);
		if(isset($config['tag_link_wrapper_before'])) $this->set_tag_link_wrapper_before($config['tag_link_wrapper_before']);
		if(isset($config['tag_link_wrapper_after'])) $this->set_tag_link_wrapper_after($config['tag_link_wrapper_after']);
		if(isset($config['display_links'])) $this->set_display_links($config['display_links']);
		if(isset($config['limit_record'])) $this->set_limit_record($config['limit_record']);
		if(isset($config['total_record'])) $this->set_total_record($config['total_record']);
		if(isset($config['query_string'])) $this->set_query_string($config['query_string']);
		if(isset($config['layout'])) $this->layout = $config['layout'];
		if(isset($config['text_prev'])) $this->text_prev = $config['text_prev'];
		if(isset($config['text_next'])) $this->text_prev = $config['text_next'];

		$this->validate_input_value();

		// Tính toán các thông số
		$this->total_links = ceil($this->total_record / $this->limit_record);
		$current_page    = $this->get_current_page();
		$this->prev_page = ($current_page > 1) ? $current_page - 1 : null;
		$this->next_page = ($current_page < $this->total_links) ? $current_page + 1 : null;
	}

	/**
	 * Lấy query string trên url
	 * @return mix
	 */
	private function get_current_query_string() {

		$query_string = $this->http_build_query($_GET);

		if( $query_string == '' ) return null;

		$url_current = $_SERVER['REQUEST_URI'];

		if($pos = strpos($_SERVER['REQUEST_URI'], '?')) {
			$url_current = substr($_SERVER['REQUEST_URI'], 0, $pos);
		}

		return $url_current . '?' . $query_string;
	}


	/**
	 * Truyền biến phân trang lên url
	 * @param  [string] $value
	 * @return string
	 */
	private function create_query_string($value) {

		// echo $this->get_current_query_string();die;
		if($this->get_current_query_string() && !isset($_GET[$this->query_string])) {
			return $this->get_current_query_string() . '&' . $this->query_string . '=' . $value;
		}
		else{
			$_get = $_GET;
			@$_get[$this->query_string] = $value;
			$url_current = $_SERVER['REQUEST_URI'];
			if($pos = strpos($_SERVER['REQUEST_URI'], '?')) {
				$url_current = substr($_SERVER['REQUEST_URI'], 0, $pos);
			}
			return $url_current . '?' . $this->http_build_query(@$_get);
		}
	}


	/**
	 * Xác định trang hiện tại
	 * @return integer
	 */
	public function get_current_page() {
		if(isset($_GET[$this->query_string])) {
			return $_GET[$this->query_string];
		}

		return 1;
	}

	public function http_build_query($data) {
		return urldecode(http_build_query($data));
	}

	/*------------------------------------------------------------------------------------
	* Các hàm set property
	*-------------------------------------------------------------------------------------*/

	public function set_query_string($query_string) {
		if(is_string($query_string)) $this->query_string = $query_string;
	}

	public function set_tag_link_before($html) {
		if(is_string($html)) {
			$this->tag_link_before = $html;
		}
	}

	public function set_tag_link_after($html) {
		if(is_string($html)) $this->tag_link_after = $html;
	}

	public function set_tag_link_wrapper_before($html) {
		if(is_string($html)) $this->tag_link_wrapper_before = $html;
	}

	public function set_tag_link_wrapper_after($html) {
		if(is_string($html)) $this->tag_link_wrapper_after = $html;
	}

	public function set_tag_link_current_before($html) {
		if(is_string($html)) $this->tag_link_current_before;
	}

	public function set_tag_link_current_after($html) {
		if(is_string($html)) $this->tag_link_current_after;
	}

	public function set_tag_link_disbled_before($html) {
		if(is_string($html)) $this->tag_link_disabled_before;
	}

	public function set_tag_link_disbled_after($html) {
		if(is_string($html)) $this->tag_link_disabled_after;
	}

	public function set_limit_record($limit_record) {
		if(!is_null($limit_record)) $this->limit_record = (int) $limit_record;
	}

	public function get_limit_record() {
		return $this->limit_record;
	}

	public function set_total_record($total_record) {
		$this->total_record = (int) $total_record;
	}

	public function get_total_record() {
		return $this->total_record;
	}

	public function set_display_links($num_links) {
		if(!is_null($num_links)) $this->display_links = (int) $num_links;
	}
}



class PaginationException extends Exception {

	const REQUIRE_TOTAL_RECORD    = 1;

	const REQUIRE_LIMIT_RECORD    = 2;

	const TYPE_ERROR_TOTAL_RECORD = 3;

	const TYPE_ERROR_LIMIT_RECORD = 4;

	public function __construct($code = null) {

		switch ($code) {
			case PaginationException::REQUIRE_TOTAL_RECORD:
				$this->message = 'Pagination::total_record must be set';
				break;

			case PaginationException::REQUIRE_LIMIT_RECORD:
				$this->message = 'Pagination::limit_record must be set';
				break;

			case PaginationException::TYPE_ERROR_TOTAL_RECORD:
				$this->message = 'Pagination::total_record must be integer';
				break;

			case PaginationException::TYPE_ERROR_LIMIT_RECORD:
				$this->message = 'Pagination::limit_record must be integer';
				break;

			default:
				$this->message = 'Something was wrong! Please try again!';
				break;
		}
	}
}

