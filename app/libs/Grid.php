<?php

/**
 * Class make data grid
 * @author Cong Luong <cong.itsoft@gmail.com>
 * @Lat edit : 23/04/2014
 */
class Grid {

	const DATA_DISPLAY_TEXT			= 1; // Kiểu hiển thị mặc định là text
	const DATA_DISPLAY_CHECKBOX	= 2; // Kiểu hiển thị dạng checkbox
	const DATA_DISPLAY_IMAGE		= 3; // Kiểu hiển thị dạng ảnh
	const DATA_DISPLAY_CURRENCY	= 6; // Kiểu hiển thị dạng tiền tệ
	const DATA_DISPLAY_DATETIME   = 7; // Kiểu hiển thị dạng ngày tháng
	const DATA_DISPLAY_ARRAY      = 8; // Kiểu hiển thị dạng mảng
	const DATA_DISPLAY_JSON       = 9; // Kiểu hiển dạng json

	const TYPE_SEARCH_LIKE	= 1; // Kiểu search like
	const TYPE_SEARCH_EQUAL	= 2; // Kiểu search equal
	const TYPE_SEARCH_GT		= 3; // Kiểu search lớn hơn
	const TYPE_SEARCH_LT		= 4; // Kiểu search nhỏ hơn

	const SEARCH_CONTROL_TEXT		= 1; // Kiểu control text
	const SEARCH_CONTROL_DROPDOWN	= 2; // Kiểu control selectbox
	const SEARCH_CONTROL_DATE     = 3; // Kiểu control date/time

	/**
	 * Khóa chính
	 * @var [type]
	 */
	protected $_primaryKey;

	/**
	 * Biến đếm
	 * @var integer
	 */
	private $_count	= 0;

	private $_count_search = 0;

	/**
	 * Đường dẫn ảnh
	 */
	protected $_imagePath;

	/**
	 * Width ảnh
	 * @var integer
	 */
	protected $_imageWidth = 100;

	/**
	 * Height ảnh
	 * @var integer
	 */
	protected $_imageHeight = 100;

	/**
	 * Mảng dữ liệu
	 * @var array
	 */
	protected $_data	= array();

	/**
	 * Mảng các tham số
	 * @var array
	 */
	protected $_arrayField					= array();
	protected $_arrayTitle					= array();
	protected $_arrayTypeDisplay			= array();
	protected $_arraySort					= array();
	protected $_arraySearch					= array();
	protected $_arrayColumnAttribute		= array();

	protected $_arrayNameSearch			= array();
	protected $_arrayTypeSearch         = array();
	protected $_arrayFieldSearch			= array();
	protected $_arrayControlSearch		= array();
	protected $_arrayDataSearch			= array();
	protected $_arrayWidthControlSearch	= array();

	/**
	 * Controllers
	 * @var string
	 */
	protected $_deleteController;
	protected $_editController;
	protected $_activeController;

	/**
	 * Paginate obj
	 * @var object
	 */
	protected $_paginate;
	protected $_currentPage;
	protected $_limitRecord;
	protected $_totalRecord;

	protected $_sequenceNumber = 1;

	private static $_instance;

	/**
	 * Search property
	 */
	private $_htmlControlSearch;
	private $_querySearch;

	/**
	 * Constructor
	 */
	private function __construct() {

	}


	/**
	 * Get an instance
	 *
	 * @return obj
	 */
	public static function getInstance() {

		if(!self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}


	/**
	 * Configuration
	 *
	 * @param  array  $config [description]
	 * @return [type]         [description]
	 */
	public static function config($config = array()) {

		$instance = self::getInstance();

		$instance->_primaryKey			= isset($config['primary_key']) ? $config['primary_key'] : null;
		$instance->_deleteController	= isset($config['delete_controller']) ? $config['delete_controller'] : null;
		$instance->_editController		= isset($config['edit_controller']) ? $config['edit_controller'] : null;
		$instance->_activeController	= isset($config['active_controller']) ? $config['active_controller'] : null;

		$instance->_imagePath			= isset($config['image_option']['path']) ? $config['image_option']['path'] : null;
		$instance->_imageWidth			= isset($config['image_option']['width']) ? $config['image_option']['width'] : null;
		$instance->_imageHeight			= isset($config['image_option']['height']) ? $config['image_option']['height'] : null;

		$instance->_currentPage			= isset($config['pagination']['current_page']) ? $config['pagination']['current_page'] :  null;
		$instance->_limitRecord			= isset($config['pagination']['limit_record']) ? $config['pagination']['limit_record'] :  null;
		$instance->_totalRecord			= isset($config['pagination']['total_record']) ? $config['pagination']['total_record'] :  null;

		$instance->_data              = isset($config['data']) ? $config['data'] : array();

		$instance->validateConfigInput();

		$instance->_paginate = new Pagination(array(
			'total_record' => $instance->_totalRecord,
			'limit_record' => $instance->_limitRecord
		));

	}


	/**
	 * Add column field
	 *
	 * @param string  $field       Tên trường
	 * @param string  $title       Tiêu hiển thị
	 * @param const  $typeDisplay  Kiểu hiển thị
	 * @param integer $sort        Có sort không
	 * @param integer $search      Có search không
	 * @param mixed  $width        Width của cột
	 */
	public static function addColumn($field, $title, $typeDisplay = Grid::DATA_DISPLAY_TEXT, $sort = 0 , $attributes = array()) {
		$instance = self::getInstance();
		$instance->_arrayField[$instance->_count]					= $field;
		$instance->_arrayTitle[$instance->_count]					= $title;
		$instance->_arraySort[$instance->_count]					= $sort;
		$instance->_arrayTypeDisplay[$instance->_count]			= $typeDisplay;
		$instance->_arrayColumnAttribute[$instance->_count]	= self::makeAttributes($attributes);
		$instance->_count++;
	}

	/**
	 * Add control search
	 *
	 * @param string $field      Tên trường
	 * @param string $nameSearch Tiêu đề control
	 * @param const $typeSearch  Kiểu search
	 */
	public static function addSearch($field, $nameSearch, $typeSearch, $typeControl, $data = array(), $width = 200) {
		$instance = self::getInstance();
		$instance->_arrayFieldSearch[$instance->_count_search]			= $field;
		$instance->_arrayNameSearch[$instance->_count_search]				= $nameSearch;
		$instance->_arrayTypeSearch[$instance->_count_search]				= $typeSearch;
		$instance->_arrayControlSearch[$instance->_count_search]			= $typeControl;
		$instance->_arrayDataSearch[$instance->_count_search]				= $data;
		$instance->_arrayWidthControlSearch[$instance->_count_search]	= $width;
		$instance->_count_search++;

		// $instance->makeControlSearch();
	}

	/**
	 * Tạo các thẻ th
	 *
	 * @return html
	 */
	public function makeHeader() {

		$instance = self::getInstance();

		$html = '<th width="10"><input type="checkbox" id="checkbox-all" /></th>';

		$html .= '<th width="10">#</th>';

		foreach($instance->_arrayTitle as $key => $title) {
			$attributes = $this->_arrayColumnAttribute[$key] ? $instance->_arrayColumnAttribute[$key] : null;
			$html .= '<th '. $attributes .'>'. $instance->makeTitle($instance->_arrayField[$key], $title, $instance->_arraySort[$key]) .'</th>';
		}

		$html .= '<th width="30" class="text-center">Del</th>';
		$html .= '<th width="30" class="text-center">Edit</th>';

		return $html;
	}


	/**
	 * Tạo phần nội dung bảng
	 *
	 * @return html
	 */
	public function makeBody() {
		$html = '';

		$sequenceNumber = $this->getSequenceNumber();

		foreach($this->_data as $item) {

			$sequenceNumber ++;

			$html .= '<tr>';

			$html .= '<td class="text-center">'. $this->addCheckboxMulti($this->_primaryKey, $item[$this->_primaryKey]) .'</td>';

			$html .= '<td>'. $sequenceNumber.'</td>';

			foreach($this->_arrayField as $key => $field) {

				$data				= isset($item[$field]) ? $item[$field] : null;
				$typeDisplay	= $this->_arrayTypeDisplay[$key];
				$class = '';
				if($typeDisplay == self::DATA_DISPLAY_CHECKBOX) {
					$class = ' class="text-center"';
				}
				$html .= '<td'. $class .'>'. $this->typeDataDisplay($item[$this->_primaryKey], $data, $typeDisplay) .'</td>';

			}

			$html .= $this->addDefaultAction($item[$this->_primaryKey]);

			$html .= '</tr>';
		}

		return $html;
	}


	/**
	 * Lấy số thự tự
	 *
	 * @return integer
	 */
	public static function getSequenceNumber() {
		$instance = self::getInstance();
		return ($instance->_currentPage - 1) * $instance->_limitRecord;
	}


	/**
	 * Action checkbox
	 *
	 * @param string $field Tên trường
	 * @param mix $value 	Dữ liệu
	 */
	public static function addCheckbox($id, $valueActive, $queryString = array()) {
		$instance = self::getInstance();
		$queryString = !empty($queryString) ? '&' . http_build_query($queryString) : '';
		$classActive = $valueActive == 1 ? 'fa-check-square' : 'fa-square-o';
		return '<a class="btn-action btn-active-action" href="'. $instance->_activeController .'?recordId='. $id . $queryString .'"><i class="fa '. $classActive .'"></i></a>';
	}


	/**
	 * Action delete
	 *
	 * @param string $field Tên trường
	 * @param mix $value 	Dữ liệu
	 */
	public static function addDelete($id, $queryString = array()) {
		$instance = self::getInstance();
		$queryString = !empty($queryString) ? '&' . http_build_query($queryString) : '';
		return '<a class="btn-action btn-delete-action" href="'. $instance->_deleteController .'?recordId='. $id . $queryString .'"><i class="fa fa-trash-o text-danger"></i></a>';
	}


	/**
	 * Action edit
	 *
	 * @param string $field Tên trường
	 * @param mix $value 	Dữ liệu
	 */
	public static function addEdit($id, $queryString = array()) {
		$instance = self::getInstance();
		$queryString = !empty($queryString) ? '&' . http_build_query($queryString) : '';
		return '<a class="btn-action btn-edit-action" href="'. $instance->_editController .'?recordId='. $id . $queryString .'"><i class="fa fa-edit"></i></a>';
	}


	/**
	 * Mặc định có 2 nút sửa và xóa
	 *
	 * @param string $field Tên trường
	 * @param mix $value 	Dữ liệu
	 */
	public static function addDefaultAction($id) {
		return '
			<td class="text-center">'. self::addDelete($id) .'</td>
			<td class="text-center">'. self::addEdit($id) .'</td>';
	}


	/**
	 * Dạng checkbox từng bản ghi
	 *
	 * @param string $field Tên trường
	 * @param mix $value 	Dữ liệu
	 */
	public static function addCheckboxMulti($field, $value) {
		return '<input type="checkbox" class="checkbox-item" name="'. $field .'" value="'. $value .'" />';
	}


	/**
	 * Phần đầu template
	 *
	 * @return html
	 */
	public static function templateTop($return = false) {
		$instance = self::getInstance();

		$html = '<div id="grid-container">';

		$html_control = $instance->makeControlSearch();

		if($html_control != '') {
			$html .= $instance->templateSearch($html_control . $instance->getHtmlControlSearch());
		}

		$html .= '<table class="table table-bordered table-striped table-hover">
						<thead>'. $instance->makeHeader() .'</thead>
							<tbody>';

		if($return) return $html;

		echo $html;
	}


	/**
	 * Thêm html bên ngoài vào template search
	 *
	 * @param string $html
	 */
	public static function addHtmlControlSearch($html) {
		$instance = self::getInstance();
		$instance->_htmlControlSearch .= '<div class="pull-left" style="margin-right:5px;margin-bottom:5px;">'. $html .'</div>';
	}



	/**
	 * [getHtmlControlSearch description]
	 *
	 * @return string
	 */
	public function getHtmlControlSearch() {
		$instance = self::getInstance();
		return $instance->_htmlControlSearch;
	}



	/**
	 * Template form search
	 *
	 * @return html
	 */
	protected function templateSearch($html_control) {
		$instance = self::getInstance();
		$html = '';
		$html .= '<form action="" method="GET" class="grid-form-search">';
		$html .='<div style="overflow:hidden">'. $html_control . '<input type="submit" value="Tìm kiếm" class="btn btn-sm btn-info" /></div>';
		$html .=	'</form>';
		return $html;
	}


	/**
	 * Phần cuối template
	 *
	 * @return html
	 */
	public static function templateBottom($return = false) {
		$instance = Grid::getInstance();
		$html = '</tbody></table>' . $instance->_paginate->paginate_links() . '</div>';
		if($return)
			return $html;
		echo $html;
	}


	/**
	 * Tùy chỉnh kiểu dữ liệu muốn hiện thị
	 *
	 * @param  mix $data          Dữ liệu
	 * @param  const $typeDisplay Kiểu hiển thị
	 * @return mix
	 */
	protected function typeDataDisplay($id, $data, $typeDisplay) {

		switch ($typeDisplay) {
			case self::DATA_DISPLAY_TEXT:
				return $data;

			case self::DATA_DISPLAY_IMAGE:
				return '<img src="'. $this->_imagePath . $data .'" width="'. $this->_imageWidth .'" height="'. $this->_imageHeight .'" />';

			case self::DATA_DISPLAY_CURRENCY:
				return '<span class="text-danger">'. number_format($data, 0,  '.', '.') .'</span>';

			case self::DATA_DISPLAY_CHECKBOX:
				return $this->addCheckbox($id, $data);

			case self::DATA_DISPLAY_DATETIME:
				return date('d/n/Y', $data);

			case self::DATA_DISPLAY_ARRAY:
				return '<pre>' . print_r($data, true);

			case self::DATA_DISPLAY_JSON:
				return json_encode($data);

			default:
				return $data;
		}
	}


	/**
	 * Tùy chỉnh tiêu đề cột
	 *
	 * @param  string	 $field Tên trường
	 * @param  string  $title Tên hiển thị
	 * @param  bool 	 $sort  Có sort hay không
	 * @return string
	 */
	protected function makeTitle($field, $title, $sort) {
		if($sort) {
			return '<a href="'. $this->createLinkSort($field) .'">'. $title .'</a>';
		}else{
			return $title;
		}
	}

	protected function makeControlSearch() {
		$instance = self::getInstance();

		$html = '';

		$style = "margin-right:5px;margin-bottom:5px;";

		foreach($this->_arrayFieldSearch as $key => $field ) {
			$nameSearch = $this->_arrayNameSearch[$key];
			$styleControl = 'style="width:'. $this->_arrayWidthControlSearch[$key] .'px"';
			switch ($this->_arrayControlSearch[$key]) {

				case self::SEARCH_CONTROL_TEXT:
					$html .= '<div class="pull-left" style="'. $style .'"><input type="text" class="form-control" name="'. $field .'" value="'. Input::get($field) .'" placeholder="'. $nameSearch .'" '. $styleControl .'/></div>';
					break;

				case self::SEARCH_CONTROL_DATE:
					$html .= '<div class="pull-left" style="'. $style .'"><input type="text" class="form-control date-picker" name="'. $field .'" value="'. Input::get($field) .'" placeholder="'. $nameSearch .'" '. $styleControl .'/></div>';
					break;

				case self::SEARCH_CONTROL_DROPDOWN:
					$html_option = '<option value="">'. $nameSearch .'</option>';
					foreach($this->_arrayDataSearch[$key] as $k => $value) {
						$checked = Input::get($field) == $k ? 'selected="selected"' : '';
						$html_option .= '<option value="'. $k .'" '. $checked .'>'. $value .'</option>';
					}
					$html .= '<div class="pull-left" style="'. $style .'"><select class="form-control" name="'. $field .'" '. $styleControl .'>'. $html_option .'</select></div>';
			}
		}

		return $html;
	}


	/**
	 * Template
	 *
	 * @return html
	 */
	protected function template() {
		return $this->templateTop(true) . $this->makeBody() . $this->templateBottom(true);
	}


	/**
	 * Hiển thị bảng dữ liệu
	 *
	 * @param  boolean $return
	 * @return mixed
	 */
	public static function draw($return = false) {
		$instance = self::getInstance();

		// Kiểm tra dữ liệu đầu vào
		$instance->validateConfigInput();

		// Phân trang
		$instance->_paginate = new Pagination(array(
			'total_record' => $instance->_totalRecord,
			'limit_record' => $instance->_limitRecord
		));

		if($return) return $instance->template();
		echo  $instance->template();
	}


	/**
	 * Hàm tạo tham số cho truy vấn ORDER
	 *
	 * @return string
	 */
	public static function getQuerySort() {
		$instance = self::getInstance();

		$fieldSort = isset($_GET['field_sort']) ? $_GET['field_sort'] : 1;
		$typeSort  = isset($_GET['type_sort']) ? $_GET['type_sort'] : 'desc';

		$sqlSort = '';
		$sqlSort .= "$fieldSort $typeSort, ";

		return $sqlSort;
	}


	/**
	 * Get query search
	 *
	 * @return string
	 */
	public static function getQuerySearch() {
		$instance = self::getInstance();

		$sql = '';

		foreach($instance->_arrayTypeSearch as $key => $type) {
			$field = $instance->_arrayFieldSearch[$key];
			if($keyword = Input::get($field)) {
				switch ($type) {
					case self::TYPE_SEARCH_LIKE:
						$sql .= ' AND ' . $field . ' LIKE "%'. $keyword .'%"';
						break;

					case self::TYPE_SEARCH_EQUAL:
						if($instance->_arrayControlSearch[$key] == self::SEARCH_CONTROL_DATE) {
							$sql .= ' AND ' . $field . '=' . strtotime(str_replace('/', '-', $keyword));
						}else{
							$sql .= ' AND ' . $field . '=' . $keyword;
						}
						break;

					case self::TYPE_SEARCH_GT:
						if($instance->_arrayControlSearch[$key] == self::SEARCH_CONTROL_DATE) {
							$sql .= ' AND ' . $field . '>' . strtotime(str_replace('/', '-', $keyword));
						}else{
							$sql .= ' AND ' . $field . '>' . $keyword;
						}
						break;

					case self::TYPE_SEARCH_LT:
						if($instance->_arrayControlSearch[$key] == self::SEARCH_CONTROL_DATE) {
							$sql .= ' AND ' . $field . '<' . strtotime(str_replace('/', '-', $keyword));
						}else{
							$sql .= ' AND ' . $field . '<' . $keyword;
						}
						break;

					default:
						$sql .= ' AND ' . $field . ' LIKE "%'. $keyword .'%"';
						break;
				}
			}
		}

		if(!$instance->_querySearch) return $sql;

		return $instance->_querySearch;
	}


	/**
	 * setQuerySearch
	 *
	 * string $query
	 */
	public static function setQuerySearch($query) {
		$instance = self::getInstance();
		$instance->_querySearch = $query;
	}

	/**
	 * Hàm tạo link sort
	 *
	 * @param  string $fieldSort Tên trường cần sort
	 * @param  string $typeSort  Loại sort
	 * @return string
	 */
	protected function createLinkSort($fieldSort , $typeSort = 'asc') {

		$queryString = array(
			'action'     => 'sort',
			'field_sort' => $fieldSort,
			'type_sort'  => $typeSort
		);

		$queryUrl = $_SERVER['QUERY_STRING'];

		$_get = array();

		foreach($_GET as $key => $value) {
			$_get[$key] = $value;
		}

		$_get['field_sort'] = $fieldSort;

		if(isset($_GET['type_sort']) && $_GET['type_sort'] == 'asc') {
			$_get['type_sort'] = 'desc';
		}else if(isset($_GET['type_sort']) && $_GET['type_sort'] == 'desc') {
			$_get['type_sort'] = 'asc';
		}else{
			$_get['type_sort'] = $typeSort;
		}

		$query = http_build_query($_get);

		if(strpos($queryUrl, '?')) {
			return '&' . $query;
		}

		return '?' . $query;
	}


	/**
	 * Generate string attributes
	 * @param  array $attributes
	 * @return string
	 */
	public static function makeAttributes($attributes) {

		$instance = self::getInstance();

		$stringAttribute = '';

		if(is_array($attributes)) {
			foreach($attributes as $key => $value) {
				$stringAttribute .= "$key=\"$value\" ";
			}
		}else{
			$stringAttribute = @strval($attributes);
		}

		return trim($stringAttribute, ' ');
	}

	/*------------------------------------------------------------------------------------------------------------------
	* Một số hàm cấu hình thuộc tính
	*------------------------------------------------------------------------------------------------------------------*/

	public static function setPrimaryKey($primaryKey) {
		$instance = self::getInstance();
		$instance->_primaryKey = $primaryKey;
	}

	public static function getPrimaryKey() {
		$instance = self::getInstance();
		return $instance->_primaryKey;
	}

	public static function setData($data) {
		$instance = self::getInstance();
		$instance->_data = array_values($data);
	}

	public static function getData() {
		$instance = self::getInstance();
		return $instance->_data();
	}

	public static function setDeleteController($url) {
		$instance = self::getInstance();
		$instance->_deleteController = $url;
	}

	public static function getDeleteController() {
		$instance = self::getInstance();
		return $instance->_deleteController;
	}

	public static function setEditController($url) {
		$instance = self::getInstance();
		$instance->_editController = $url;
	}

	public static function getEditController() {
		$instance = self::getInstance();
		return $instance->_editController;
	}

	public static function setActiveController($url) {
		$instance = self::getInstance();
		$instance->_activeController = $url;
	}

	public static function getActiveController() {
		$instance = self::getInstance();
		return $instance->_activeController;
	}

	public static function setImageOption($config) {
		$instance = self::getInstance();
		$instance->_imagePath	= isset($config['path']) ? $config['path'] : null;
		$instance->_imageWidth	= isset($config['width']) ? $config['width'] : null;
		$instance->_imageHeight	= isset($config['height']) ? $config['height'] : null;
	}

	public static function getImageOption() {
		$instance = self::getInstance();
		return array(
			'path'	=> $instance->_imagePath,
			'width'	=> $instance->_imageWidth,
			'height'	=> $instance->_imageHeight
		);
	}

	public static function setPaginateOption($config) {
		$instance = self::getInstance();
		$instance->_currentPage = isset($config['current_page']) ? $config['current_page'] : null;
		$instance->_totalRecord = isset($config['total_record']) ? $config['total_record'] : null;
		$instance->_limitRecord = isset($config['limit_record']) ? $config['limit_record'] : null;

		$instance->validateConfigInput();

		$instance->_paginate = new Pagination(array(
			'total_record' => $instance->_totalRecord,
			'limit_record' => $instance->_limitRecord
		));
	}

	public static function getPaginateOption() {
		$instance = self::getInstance();
		return array(
			'current_page' => $instance->_currentPage,
			'total_record' => $instance->_totalRecord,
			'limit_record' => $instance->_limitRecord
		);
	}

	protected function validateConfigInput() {
		$instance = self::getInstance();
		if(!$instance->_primaryKey) throw new GridException(GridException::REQUIRED_PRIMARYKEY);
		if(!$instance->_deleteController) throw new GridException(GridException::REQUIRED_DELETE_CONTROLLER);
		if(!$instance->_editController) throw new GridException(GridException::REQUIRED_EDIT_CONTROLLER);
		if(is_null($instance->_currentPage)) throw new GridException(GridException::REQUIRED_PAGINATION_CURRENT_PAGE);
		if(is_null($instance->_totalRecord)) throw new GridException(GridException::REQUIRED_PAGINATION_TOTAL_RECORD);
		if(is_null($instance->_limitRecord)) throw new GridException(GridException::REQUIRED_PAGINATION_LIMIT_RECORD);
	}


}


/**
 * Exception
 */
class GridException extends Exception {

	const REQUIRED_PRIMARYKEY					= 1;
	const REQUIRED_DELETE_CONTROLLER			= 2;
	const REQUIRED_EDIT_CONTROLLER			= 3;
	const REQUIRED_PAGINATION_CURRENT_PAGE	= 4;
	const REQUIRED_PAGINATION_TOTAL_RECORD	= 5;
	const REQUIRED_PAGINATION_LIMIT_RECORD	= 6;

	public function __construct($code = null) {
		switch ($code) {

			case self::REQUIRED_PRIMARYKEY:
				$this->message = 'Grid::_primaryKey must be set';
				break;

			case self::REQUIRED_DELETE_CONTROLLER:
				$this->message = 'Grid::_deleteController must be set';
				break;

			case self::REQUIRED_EDIT_CONTROLLER:
				$this->message = 'Grid::_editController must be set';
				break;

			case self::REQUIRED_PAGINATION_CURRENT_PAGE:
				$this->message = 'Grid::_currentPage must be set';
				break;

			case self::REQUIRED_PAGINATION_LIMIT_RECORD:
				$this->message = 'Grid::_limitRecord must be set';
				break;

			case self::REQUIRED_PAGINATION_TOTAL_RECORD:
				$this->message = 'Grid::_totalRecord must be set';
				break;

			default:
				$this->message = 'Something was wrong! Please try again!';
				break;
		}
	}
}