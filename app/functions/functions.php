<?php
/**
 * Tạo link sắp xếp
 * @param  string $fieldSort - field cần sort
 * @param  string $typeSort  - kiểu sort
 * @return link
 */
function createLinkSort($fieldSort , $typeSort = 'asc') {

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
 * Tao chu khong dau & thay the dau cach bang dau -
 * @param  [type] $string     [description]
 * @param  string $keyReplace [description]
 * @return [type]             [description]
 */
function removeTitle($string, $keyReplace = "/"){
	$string = removeAccent($string);
	$string =  trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
	$string =  str_replace(" ","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace($keyReplace,"-",$string);
	return strtolower($string);
}

/**
 * Remove tieng viet thanh khong dau
 * @param  [type] $string [description]
 * @return [type]         [description]
 */
function removeAccent($string) {
	$marTViet = array(
	// Chữ thường
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ","Đ","'",
	// Chữ hoa
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ","Đ","'",
	);
	$marKoDau=array(
		/// Chữ thường
		"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d","D","",
		//Chữ hoa
		"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D","D","",
		);
	return str_replace($marTViet, $marKoDau, $string);
}

/**
 * Hàm format định dạng số
 * @param  number  $number
 * @return string
 */
function format_number($number){

	if(is_numeric($number)) {
	   $return  = number_format($number, 2, ".", ",");
	   if(intval(substr($return, -2, 2)) == 0) $return = number_format($number, 0, ".", ".");
	   elseif(intval(substr($return, -1, 1)) == 0) $return = number_format($number, 1, ".", ".");
	   return $return;
	}

	return null;
}

/**
 * Convert format date to unix timestamp
 * @param  string $dateFormat
 * @return integer
 */
function dateToInteger($dateFormat) {

	$dateFormat = preg_replace('/[^0-9]/', '/', $dateFormat);

	if(preg_match('/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/', $dateFormat)) {

		$explodeDate = explode('/', $dateFormat);

		$day   = $explodeDate[0];
		$month = $explodeDate[1];
		$year  = $explodeDate[2];

		return mktime(0, 0, 0, $month, $day, $year);
	}

	return null;
}

/**
 * Cut substring in string
 * @param  [type] $string
 * @param  string $ext
 * @return string
 */
function cutString($string, $start = 0, $length = 250, $ext = '...') {
	$string =  mb_substr($string, 0, $length) . $ext;
	return $string;
}


/**
 * Show banner by page and position
 * @param  string $page
 * @param  string $position
 * @return html
 */
function show_banners($page, $position, $limit = 5, $image_size = "") {
	$banners = Banner::where('ban_page', '=', $page)
							->where('ban_position', '=', $position)
							->where('ban_active', 1)
							->orderBy('ban_update_time', 'DESC')
							->get();
	$html	= '';
	if(!is_null($banners)) foreach($banners as $banner)  {
		$html .= '<div style="margin-bottom:5px"><a style="display:block" href="'. $banner->ban_url .'" target="_blank"><img src="'. PATH_IMAGE_BANNER . $image_size . $banner->ban_picture .'" style="width:100%"></a></div>';
  	}

  	return $html;
}

/**
 * Add params to url
 * @param  array  $params [key => value]
 * @return query string
 */
function url_add_params(array $params) {
	$array_url_params = array();

	foreach($_GET as  $key => $value) {
		$array_url_params[$key] = $value;
	}

	if(!empty($params)) {
		foreach($params as $k => $v) {
			$array_url_params[$k] = $v;
		}
	}

	$url_current = $_SERVER['REQUEST_URI'];

	if($pos = strpos($_SERVER['REQUEST_URI'], '?')) {
		$url_current = substr($_SERVER['REQUEST_URI'], 0, $pos);
	}

	return $url_current . '?' . urldecode(http_build_query($array_url_params));
}

/**
 * Tạo url filter box theo các tiêu chí
 * @param  string $add_key     key
 * @param  string $add_value   value
 * @return url
 */
function url_filter_box($add_key, $add_value) {

	$query_string = $_SERVER['REQUEST_URI'];

	$query_return = '?'.$add_key.'[]=' . $add_value;

   if(strpos($query_string, '?') !== false) {
      $query_return = $query_string . '&'.$add_key.'[]=' . $add_value;
   }

   $checked = '';

   if(isset($_GET[$add_key]) && in_array($add_value, $_GET[$add_key])) {
      $checked = 'checked';
      $query_return = str_replace('&'.$add_key.'[]=' . $add_value, '', $query_return);
      $query_return = str_replace('?'.$add_key.'[]=' . $add_value, '', $query_return);
   }

   $query_return = preg_replace('/^(.*).html(&)(.*)/', '${1}.html?${3}', $query_return);

	return array(
		'checked' => $checked,
		'url' => $query_return
	);
}

/**
 * Convert an array object to an array
 * @param  array $data
 * @return array
 */
function convertArrayObjToArray($data) {
	$result = array();

	foreach($data as $key => $value) {
		$result[$key] = (array) $value;
	}

	return $result ? $result : $data;
}

//Các hàm tiện ích cho pagination
function pagination_label($pagination) {
   return "Hiển thị từ  {$pagination->getFrom()} tới {$pagination->getTo()} của {$pagination->getTotal()}";
}

/**
* Đưa sđt về dạng chuẩnab
*
* @param mixed $phone_number Description.
*
* @return mixed Value.
*/
function valid_phone($phone_number) {

	$valid_phone	= '';
	$phone_number	= strval($phone_number);
	$first			= substr($phone_number, 0, 1);
	if($first == '0') {
		$first	= '84';
		$valid_phone = $first . substr($phone_number, 1);
	}elseif($first != "+") {
		$valid_phone	= $phone_number;
	}else{
		$valid_phone	= substr($phone_number, 1);
	}

	// Chỉ lấy ký tự số
	$pattern 		= '(\D)';
	$valid_phone	= preg_replace($pattern, '', $valid_phone);

	return $valid_phone;
}


/**
 * Xóa khoảng trắng, xuống dòng
 * @param  [type] $buffer [description]
 * @return [type]         [description]
 */
function sanitize_output($buffer) {
   $search = array(
        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
        '/[^\S ]+\</s', //strip whitespaces before tags, except space
        '/(\s)+/s',  // shorten multiple whitespace sequences
        '#<!--([^/]*)-->#'
        );

   $replace = array(
        '>',
        '<',
        '\\1',
        ''
        );

  	$buffer = preg_replace($search, $replace, $buffer);

   return $buffer;
}


/**
 * Đưa giá về dạng chuẩn - dạng số
 *
 * @param  string $price
 * @return number
 */
function toNumberic($price) {
	$string      = $price;
	$pattern     = "/\D*/"; // Không phải dạng số
	$replacement = ""; // Replace thành rỗng
	$price       = preg_replace($pattern, $replacement, $string);
	return $price ? $price : null;
}

/**
 * Debug Query
 *
 * @return array()
 */
function debugQuery() {
	$queries = DB::getQueryLog();
	debug($queries);
}


/**
 * Debug function
 */
function _debug($data) {

	$ip_allow = json_decode(file_get_contents(BASE_PATH . '/ip_allow.json'), true);

	if(!in_array(@$_SERVER['REMOTE_ADDR'], $ip_allow )) {
		return ;
	}

	echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
	echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';

	$debug_backtrace = debug_backtrace();
	$debug = array_shift($debug_backtrace);

	echo '<div>File: ' . $debug['file'] . '</div>';
	echo '<div>Line: ' . $debug['line'] . '</div>';

	if(is_array($data) || is_object($data)) {
		print_r($data);
	}
	else {
		var_dump($data);
	}
	echo '</pre>';
}

/*
* $key - Field data need validate
* @return true|false
*/
function hasError($key) {
	$errors = Session::get('errors');
	if (count($errors) && $errors->has($key)) {
	  return true;
	}
	return false;
}
/*
* $key - Field data need validate
* @return Nếu có lỗi thì add class has-error, ngược lại
*/
function hasValidator($key) {
	$status = '';
	if (hasError($key)) {
	  $status = 'has-error';
	} elseif (Session::has('errors') && !hasError($key)) {
	  $status = 'has-success';
	}
	return $status;
}

function alertError($key) {
	$errors = Session::get('errors');
	if (hasError($key)) {
		return $errors->first($key, '<p class="help-inline text-danger">:message</p>');
	}
	return '';
}


function isLocalhost() {
	return @$_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? true : false;
}


/**
 * Get html breadcrumb item
 *
 * @param  string  $name
 * @param  string  $url
 * @param  boolean $active
 * @return html
 */
function getBreadcrumbItem($name, $url, $active = false) {
	$class_active = $active ? 'active' : 'normal';

	if($active) {
		$link_item = '<span itemprop="title">'. strip_tags($name) .'</span>';
	}else {
		$link_item = '<a href="'. $url .'" itemprop="url">
				   	<span itemprop="title">'. strip_tags($name) .'</span>
						</a>';
	}

	return '<li class="'. $class_active .'">'. $link_item .'</li>';
}


/**
 * Get html list breadcrumb
 *
 * @param  integer $catId - ID của danh mục
 * @param  bool $thisActive - Có muốn để trạng thái active cho cat này không
 * @return html
 */
function getBreadcrumb($catId, $thisActive = true) {

	# Lấy các cat cha
	$id_cat_parents = Category::getListParents($catId, Category::getCategoriesArray());
	array_push($id_cat_parents, $catId);
	$cat_parents = Category::whereIn('id', $id_cat_parents)->get();

	$html_breadcrumb_item = '';
	foreach($cat_parents as $key => $cat) {
		$active = ($catId == $cat->id && $thisActive) ? true : false;
		$html_breadcrumb_item .= getBreadcrumbItem($cat->name, $cat->getUrl(), $active);
	}

	return  $html_breadcrumb_item;
}

/*
* Ham xu ly cat chuoi
* @param string $text
 */
function the_content($text) {
	$sanitized = htmlentities($text, ENT_COMPAT, 'UTF-8');
	return str_replace(array("\r\n", "\n"), array("<p>", "</p>"), $sanitized);
}


# Cat chuoi cho text
function the_excerpt($text, $string = 400) {
	$sanitized = htmlspecialchars($text, ENT_QUOTES, "UTF-8");
	if (strlen($sanitized) > $string) {
		$cutString = substr($sanitized, 0, $string);
		$words = substr($sanitized, 0, strrpos($cutString, ' '));
	return $words;
	} else {
		return $sanitized;
	}
}

# Cat chuoi cho description meta
function the_description($text, $string = 160) {
	return the_excerpt($text, $string);
}


/**
 * Chuyển 1 đối tượng thành mảng
 * @param  $object
 * @return array
 */
function objectToArray($object) {
	return (array) $object;
}

/**
 * Chuyển 1 mảng các đối tượng thành mảng các mảng
 * @param  array $objects
 * @return array
 */
function objects2Arrays($objects) {
	return array_map('objectToArray', $objects);
}


/**
 * Chuyển 1 mảng các ID thành 1 chuỗi ID phục vụ query IN()
 *
 * @param  array $array Mảng cần chuyển đổi
 * @return mixed
 */
function convertArrayToList($array) {
	$list = '';

	$result = array();

	foreach($array as $key => $value) {
		$result[] = (int) $value;
	}

	$result = array_unique($result);

	foreach($result as $key => $value) {
		$list .= (int) $value . ',';
	}

	if($list == '') {
		return 0;
	}

	return trim(substr($list, 0, -1));
}

// Hiển thị trạng thái của dữ liệu
function show_status($route, $parameters) {

	if (isset($parameters['type']) && $parameters['type'] == 1) {
	  $parameters['type'] = 0;
	  return '<a class="label tt btn-flat label-success" href="' . route($route, $parameters) . '" data-type="0" data-container="body" data-toggle="tooltip" data-placement="bottom" data-original-title="Không hiển thị"><i class="fa fa-hand-o-up"></i></a>';
	}

	$parameters['type'] = 1;
	return '<a class="label tt btn-flat label-danger" href="' . route($route, $parameters) . '" data-type="1" data-container="body" data-toggle="tooltip" data-placement="bottom" data-original-title="Hiển thị trang chủ"><i class="fa fa-hand-o-down"></i></a>';
}

/**
 * Tạo url filter nhiều tiêu chí
 *
 * @param  string $key   Tên param
 * @param  string $value Giá trị param
 * @return array
 */
function makeUrlFilterMulti($key, $value) {

	if(isset($_GET['page'])) unset($_GET['page']);

	if(isset($_GET[$key]) && $_GET[$key] != '') {
		$key_get = $_GET[$key];

		$key_get_value = explode(':', $key_get);

		// Nếu nằm trong giá trị của $_GET thì unset ngay
		if(in_array($value, $key_get_value)) {
			$k = array_search($value, $key_get_value);
			if($k !== false) {
				unset($key_get_value[$k]);
				$url = url_add_params(array($key => implode(':', $key_get_value)));
				return array('url' => $url, 'active' => 1);
			}
		}
		// Chưa có trong $_GET thì thêm vào
		else{
			array_push($key_get_value, $value);
			$url = url_add_params(array($key => implode(':', $key_get_value)));
			return array('url' => $url, 'active' => 0);
		}
	}

	return array('url' => url_add_params(array($key => $value)), 'active' => 0);
}


function curlGetContent($url, $timeOut = 60, $callback = null) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSLVERSION,3);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,$timeOut);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$data = curl_exec ($ch);
	$error = curl_error($ch);

	curl_close ($ch);
	return $data;
}

function microtime_float(){
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

function getQuery($query, $params) {
	$keys = array();

	# build a regular expression for each parameter
	foreach ($params as $key => $value) {
	  if (is_string($key)) {
	      $keys[] = '/:'.$key.'/';
	  } else {
	      $keys[] = '/[?]/';
	  }
	}

	$query = preg_replace($keys, $params, $query, 1, $count);

	#trigger_error('replaced '.$count.' keys');

	return $query;
}

/**
 * Get model by action | add-edit-delete
 *
 * @param  class  $model
 * @param  string  $action
 * @param  integer $id
 * @return mixed
*/
function getModelByAction($model, $id = 0) {

	if(!class_exists($model)) throw new Exception('Model '. $model .' not exist');

	if($id > 0) {
		return $model::find($id);
	}

	return new $model;

}


/**
 * Hàm load meta, title, stylesheet
 *
 * @param  callback $callback
 * @return void
 */
function fsdHead($echo = true) {

	$setting = App::make('metadata');

	$hookPlugin = 'head_style';

	$meta = '
		<meta charset="utf-8" />
		<title>'. $setting->getTitle() . ' :: ' . $setting->getOwner() .'</title>

		<meta name="author" content="'. $setting->getOwner() .'"/>
		<meta name="keywords" content="'. $setting->getKeywords() .'">
		<meta name="description" content="'. $setting->getDescription() .'">
		<meta content="noodp,index,follow" name="robots">

		<meta itemprop="name" content="'. $setting->getTitle() .'">
		<meta itemprop="description" content="'. $setting->getDescription() .'">
		<meta itemprop="image" content="'. $setting->getOgImage() .'">

		<meta name="twitter:card" content="product">
		<meta name="twitter:site" content="'. url() .'">
		<meta name="twitter:title" content="'. $setting->getTitle() .'">
		<meta name="twitter:description" content="'. $setting->getDescription() .'">
		<meta name="twitter:creator" content="cong.itsoft@gmail.com">
		<meta name="twitter:image" content="'. $setting->getOgImage() .'">

		<meta property="og:title" content="'. $setting->getTitle() . ' :: ' . $setting->getOwner() .'">
		<meta property="og:keywords" content="'. $setting->getKeywords() .'">
		<meta property="og:description" content="'. $setting->getDescription() .'">
		<meta property="og:url" content="'. URL::current() .'">
		<meta property="og:site_name" content="'. url() .'">
		<meta property="og:type" content="product">
		<meta property="og:image" content="'. $setting->getOgImage() .'">
		<meta property="og:price:amount" content="1.00" />
		<meta property="og:price:currency" content="VND" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<base id="baseURL" href="'. url() .'"/>

		<link href="'. asset('assets/css/bootstrap.min.css') .'" rel="stylesheet"/>
      <link href="'. asset('assets/css/font-awesome.min.css') .'" rel="stylesheet"/>
      <link href="'. asset('assets/css/header.css') .'" rel="stylesheet">
      <link href="'. asset('assets/css/board.css') .'" rel="stylesheet">
      <link href="'. asset('assets/css/normalize.css') .'" rel="stylesheet"/>
      <link href="'. asset('assets/css/master.css') .'" rel="stylesheet"/>
      <link href="'. asset('assets/css/site.css') .'" rel="stylesheet"/>
      <link href="'. asset('assets/css/typeahead.js-bootstrap.css') .'" rel="stylesheet" />
      <link href="'. asset('assets/css/jquery-ui.min.css') .'" rel="stylesheet" />

      '. doAction($hookPlugin) .'

      <link href="https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic|Roboto+Condensed:400,400italic|Roboto+Slab&subset=latin,vietnamese" rel="stylesheet" type="text/css"/>

      <script src="'. asset('assets/js/jquery.1.10.2.min.js') .'"></script>
		<script src="'. asset('assets/js/html5.js') .'"></script>

		<link rel="shortcut icon" href="'. asset('assets/ico/favicon.png') .'">
	';

	if($echo) {
		echo $meta;
	} else {
		return $meta;
	}
}

/**
 * Hàm load script, time load page
 *
 * @param  int $startTime Start time load
 * @param  callback $callback
 *
 * @return void
 */
function fsdFooter($startTime = 0, $echo = true, $pluginCallback = null) {

	$setting = App::make('metadata');

	$hookPlugin = 'footer_jquery_plugin';

	$script = '
		<script src="'. asset('assets/js/jquery.bxslider/jquery.bxslider.min.js') .'"></script>
		<script src="'. asset('assets/js/underscore-min.js') .'"></script>
		<script src="'. asset('assets/js/backbone-min.js') .'"></script>
		<script src="'. asset('assets/js/jquery-ui.min.js') .'"></script>
		<script src="'. asset('assets/js/jquery.lazyload.min.js') .'"></script>
		<script src="'. asset('assets/js/bootstrap.min.js') .'"></script>
		<script src="'. asset('assets/js/bootbox.js') .'"></script>
	   <script src="'. asset('assets/js/angular.min.js') .'"></script>
	   <script src="'. asset('assets/js/angular-route.js') .'"></script>
		<script src="'. asset('assets/js/jquery.wookmark.min.js') .'"></script>
		<script src="'. asset('assets/js/typeahead.bundle.min.js') .'"></script>
		<script src="'. asset('assets/js/search_auto_complete.js') .'"></script>
		'. doAction($hookPlugin) .'
		<script src="'. asset('assets/js/common.js') .'"></script>
		<script src="'. asset('assets/js/base.js') .'"></script>
		<script src="'. asset('assets/js/collection.js') .'"></script>
		<script src="'. asset('assets/js/functions.js') .'"></script>
		<script src="'. asset('assets/js/site.js') .'"></script>
		'. $setting->getGACode() .'
	';

	if($startTime > 0) {
		$script .= Template::getQueriesExecute();
		$script .= Template::getTimeLoadPage($startTime, microtime_float());
	}

	if($echo) {
		echo $script;
	} else {
		return $script;
	}
}



function addScript($src, $priority = 0) {
	return '<script src="'. $src .'"></script>';
}


function replace_keyword_search($keyword, $lower=1){
	if($lower == 1) $keyword	= mb_strtolower($keyword, "UTF-8");
	$keyword	= replaceMQ($keyword);
	$arrRep	= array("'", '"', "-", "+", "=", "*", "?", "/", "!", "~", "#", "@", "%", "$", "^", "&", "(", ")", ";", ":", "\\", ".", ",", "[", "]", "{", "}", "‘", "’", '“', '”');
	$keyword	= str_replace($arrRep, " ", $keyword);
	$keyword	= str_replace("  ", " ", $keyword);
	$keyword	= str_replace("  ", " ", $keyword);
	return $keyword;
}

function replaceMQ($text){
	$text	= str_replace("\'", "'", $text);
	$text	= str_replace("'", "''", $text);
	$text	= str_replace("\\", "", $text);
	return $text;
}

/**
 * Hàm tạo mã sản phẩm duy nhất
 * Kết hợp mã người dùng nhập với ID sản phẩm
 * Lưu vào DB thì mã = $productCode_$productId
 * Người dùng chỉ nhìn $productCode
 *
 * @param  integer $productId - ID sản phẩm
 * @param  string  $productCode - Mã sản phẩm người dùng nhập
 *
 * @return string
 */
function makeProductCode($productId = 0, $productCode = '') {
	if(!$productCode) $productCode = time();
	if(!$productId) $productId = uniqid();
	return $productCode . '_' . $productId;
}


/**
 * Hàm lấy ra mã sản phẩm của ngưòi dùng
 *
 * @param  string $productCode - Mã sp sau khi qua hàm makeProductCode
 * @return string
 */
function getUserProductCode($productCode) {
	return substr($productCode, 0, (strrpos($productCode, '_')));
}


/**
 * Log Function
 * @param  string $filename Ten file
 * @param  string $content  Noi dung
 * @return void
 */
function logs($filename, $content){
	$arrayInfo = debug_backtrace();

	if(isset($arrayInfo[1]['function'])) {
		$function = $arrayInfo[1]['function'];
		$arrayInfo = end($arrayInfo);
	}else{
		$arrayInfo = array_shift($arrayInfo);
		$function = $arrayInfo['function'];
	}

	$log_path  =   BASE_PATH . "app/storage/logs/";
	$handle    =   @fopen($log_path . $filename . ".cfn", "a");
	//Neu handle chua co mo thêm ../
	if (!$handle) $handle = @fopen($log_path . $filename . ".cfn", "a");
	//Neu ko mo dc lan 2 thi exit luon
	if (!$handle) return;

	fwrite($handle,
		"[". date("d/m/Y - G:i:s") . "] " .
		"[" . $arrayInfo['file'] . " on line:" . $arrayInfo['line'] . " ] ".
		"[IP: " . @$_SERVER['REMOTE_ADDR'] . "] Message: " . trim($content) . "\n");
	fclose($handle);
}

function array_unshift_assoc(&$arr, $key, $val)
{
	$arr = array_reverse($arr, true);
	$arr[$key] = $val;
	return array_reverse($arr, true);
}


function imageLazyLoad($url, $alt = '', $class = '', $id = '') {
	return '<img data-original="'. $url .'" class="lazy '. $class .'" alt="'. $alt .'">';
}


/**
 * Convert ngày tháng sang unixtimestamp
 *
 * @param  string $dateStr  Chuỗi định dạng ngày tháng
 * @param  string $hour     Chuỗi định dạng giờ::phút::giây nối vào để lấy time chính xác
 *
 * @return unixtimestamp
 */
function convertDateToTime($dateStr, $hour = '00:00:00') {
	$dateStr = str_replace('/', '-', $dateStr);
	return strtotime($dateStr . ' ' . trim($hour));
}


/**
 * Add a hook
 *
 * @param string $actionName
 * @param callback $handle
 * @param array  $params
 */
function addAction($actionName, $handle, $params = array()) {
	$hooks = &$GLOBALS['fsd_hooks'];
	$hooks[$actionName][] = array('callback' => $handle, 'params' => $params);
}


/**
 * Do a hook
 *
 * @param  string $actionName
 *
 * @return mixed
 */
function doAction($actionName) {
	$hooks = $GLOBALS['fsd_hooks'];
	$result = null;
	if(array_key_exists($actionName, $hooks)) {
		foreach($hooks[$actionName] as $info) {
			if(is_callable($info['callback'])) {
				$result .= call_user_func_array($info['callback'], $info['params']);
			}
		}
	}

	return $result;
}

/**
 * Check URL
 *
 * @param  string  $url
 * @return boolean
 */
function isURL($url) {
	return filter_var($url, FILTER_VALIDATE_URL);
}


/**
 * Check email
 *
 * @param  string  $email
 * @return boolean
 */
function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}


/**
 * Check IP
 *
 * @param  string  $ip
 * @return boolean
 */
function isIP($ip) {
	return filter_var($ip, FILTER_VALIDATE_IP);
}

/**
 * Get url current
 * ex: http://example.com
 *
 * @return url
 */
function urlCurrent() {
	return 'http://' . $_SERVER['HTTP_HOST'];
}


function addScriptV2($path) {
	return addScript(PATH_STATIC . $path);
}


function addStyleSheet($path) {
	return '<link type="text/css" rel="stylesheet" href="'. PATH_STATIC . $path .'">';
}


/**
 * Get All Permissions in subdomain
 *
 * @return array
 */
function getAllPermissions() {
	// Get all permisions for this user
	$permissions = Config::get("account_permission");
	$permissionsAllGranted = [];

	foreach($permissions as $key => $permission) {
		foreach($permission['permissions'] as $permissionDetail) {
			$permissionsAllGranted[$permissionDetail['name']] = 1;
		}
	}

	return $permissionsAllGranted;
}


function getAllAdminPermissions() {
	// Get all permisions for this user
	$permissions = Config::get("permissions");
	$permissionsAllGranted = [];

	foreach($permissions as $key => $permission) {
		foreach($permission['permissions'] as $permissionDetail) {
			$permissionsAllGranted[$permissionDetail['name']] = 1;
		}
	}

	return $permissionsAllGranted;

}


function getAllAdminPermissionsUnCheck() {
	// Get all permisions for this user
	$permissions = Config::get("permissions");
	$permissionsAllGranted = [];

	foreach($permissions as $key => $permission) {
		foreach($permission['permissions'] as $permissionDetail) {
			$permissionsAllGranted[$permissionDetail['name']] = 0;
		}
	}

	return $permissionsAllGranted;
}


function array_merge_numeric_values() {
	$arrays = func_get_args();
	$merged = array();
	foreach ($arrays as $array)
	{
		foreach ($array as $key => $value)
		{
			if ( ! is_numeric($value))
			{
				continue;
			}
			if ( ! isset($merged[$key]))
			{
				$merged[$key] = $value;
			}
			else
			{
				$merged[$key] += $value;
			}
		}
	}
	return $merged;
}

/**
 * Lấy tất cả các ngày trong tuần từ 1 ngày bất kỳ
 *
 * @param  string $date
 * @return array
 */
function getDaysOfWeekFromDay($time = null) {
	if(!$time) $time = time();

	$dayOfWeek = date('N', $time);

	$weeks[$dayOfWeek] = date('d/m/Y');

	for($i = $dayOfWeek - 1; $i >= 1; $i--) {
		$weeks[$dayOfWeek-$i] = date('d') - $i . '/' . date('m') . '/' . date('Y');
	}

	for($i = 1; $i <= (7 - $dayOfWeek); $i++) {
		$weeks[$dayOfWeek+$i] = date('d') + $i . '/' . date('m') . '/' . date('Y');
	}

	asort($weeks);

	return $weeks;
}

/**
 * Get class name without namespace
 *
 * @param  object $obj
 * @return string
 */
function get_real_class($obj) {
   $classname = get_class($obj);

   if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
      $classname = $matches[1];
   }

   return $classname;
}


function styleBackgroundCover($urlImage, $with = 0, $height = 0) {
	$style = 'background: #ccc url(\''. $urlImage .'\') center center no-repeat;background-size: cover; display:block';
	if($with > 0) $style .= 'width: '. $with . 'px';
	if($height > 0) $style .= 'height: '. $height . 'px';
	return $style;
}

/** Function Dump Data **/
/**
* @param: data: Du lieu
* @param: str_note: Hien thi chu thich ve data
* @param: type: Kieu dump du lieu -- 1: var_dump, 2: print_r, 3: echo
* @param: show: true: cho hien thi luon | false: chi hien thi o local va DEV
**/
function dump_data($data, $str_note = "", $type = 2, $show = false) {
   //global $debug_allow;
   //Mảng chứa những IP check dump dữ liêu trên server
   //$array_debug_ip = array(MY_IP);
   /** DEBUG ALLOW **/
   $debug_allow = 0;
   if (($_SERVER["SERVER_NAME"] == 'dev.mytour.vn') || $_SERVER["SERVER_ADDR"] == '127.0.0.1' || $_SERVER['SERVER_NAME'] == "localhost" || ($_SERVER["SERVER_NAME"] == 'devhms.mytour.vn')) {
      $debug_allow = 1;
   }

   if ($show) {
      $debug_allow = 1;
   }

   $name = "";
   $back_track = debug_backtrace();
   $caller     = array_shift($back_track);
   foreach($GLOBALS as $var_name => $value) {
     if ($value === $data) {
         $name = $var_name;
     }
   }
   //$name = variable_name($data);
   if ($debug_allow == 1) {
      echo '<pre style="position: relative;float: left; z-index: 99999; background: black; color: #FFF; width: 100%; max-height: 600px; overflow: auto; padding: 5px; border-top: 3px solid #d31a1a;">';
      switch ($type) {
         case 1:
            echo "<span style='display:block; text-align: center; background: #D6D61F; font-weight: 600; color: #111;'>DUMP IN (" . $caller['file'] . " -- line: " . $caller['line'] . ")</span>";
            if ($name != "") {
               echo "<span style='display:block; text-align: center;font-weight: 600;padding: 4px 0px;color: #00B8FF;'>$" . $name . ($str_note != '' ? " (" . $str_note . ")" : "") . "</span>";
            }
            var_dump($data);
            break;
         case 2:
            echo "<span style='display:block; text-align: center; background: #D6D61F; font-weight: 600; color: #111;'>DUMP IN (" . $caller['file'] . " -- line: " . $caller['line'] . ")</span>";
            if ($name != "") {
               echo "<span style='display:block; text-align: center;font-weight: 600;padding: 4px 0px;color: #00B8FF;'>$" . $name . ($str_note != '' ? " (" . $str_note . ")" : "") . "</span>";
            }
            print_r($data);
            break;
         case 3:
            echo "<span style='display:block; text-align: center; background: #D6D61F; font-weight: 600; color: #111;'>DUMP IN (" . $caller['file'] . " -- line: " . $caller['line'] . ")</span>";
            if ($name != "") {
               echo "<span style='display:block; text-align: center;font-weight: 600;padding: 4px 0px;color: #00B8FF;'>$" . $name . ($str_note != '' ? " (" . $str_note . ")" : "") . "</span>";
            }
            echo $data;
            break;
         default:
            echo "<span style='display:block; text-align: center; background: #D6D61F; font-weight: 600; color: #111;'>DUMP IN (" . $caller['file'] . " -- line: " . $caller['line'] . ")</span>";
            if ($name != "") {
               echo "<span style='display:block; text-align: center;font-weight: 600;padding: 4px 0px;color: #00B8FF;'>$" . $name . ($str_note != '' ? " (" . $str_note . ")" : "") . "</span>";
            }
            print_r($data);
            break;
      }
      echo '</pre>';
   }
}