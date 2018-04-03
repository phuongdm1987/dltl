<?php

class Helper {

	/**
	 * Get youtube id from url
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public static function getYouTubeIdFromURL($url){
	  	// $url_string = parse_url($url, PHP_URL_QUERY);
	  	// parse_str($url_string, $args);
	  	// return isset($args['v']) ? $args['v'] : false;
	  	$pattern =
        '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
        ;

      $pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
	   $result = preg_match($pattern, $url, $matches);

	   // if (false !== $result) {
	   //    return $matches[1];
	   // }
	   // return false;

	   if( false !== $result && isset($matches[7]) ) {
	   	return $matches[7];
	   }

	   return false;
	}


	/**
	 * Lay anh video youtube va resize anh
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public static function getYoutubePictureFromURL($url) {
		$result = array(
			'status' => 0,
			'filename' => ''
		);
		$youtubeId     = self::getYouTubeIdFromURL($url);
		if($youtubeId != false) {
			$sourceImage   = file_get_contents('http://img.youtube.com/vi/'. $youtubeId .'/hqdefault.jpg');
			$pathSaveImage = PATH_UPLOAD_PICTURE . $youtubeId . '.jpg';
			$desImage      = file_put_contents($pathSaveImage, $sourceImage);

			//Resize anh
			$upload = new Image();
		 	$arrayResize = array(
				'small'  => array('width' => 150, 'height' => 5000),
				'medium' => array('width' => 460, 'height' => 5000)
			);
			$result = $upload->resize($pathSaveImage, PATH_UPLOAD_PICTURE, $arrayResize);
		}
		return $result;
	}


	/**
	 * Tao chu khong dau & thay the dau cach bang dau -
	 * @param  [type] $string     [description]
	 * @param  string $keyReplace [description]
	 * @return [type]             [description]
	 */
	public static function removeTitle($string,$keyReplace = "/"){
		$string = self::removeAccent($string);
		$string  =  trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
		$string  =  str_replace(" ","-",$string);
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
	public static function removeAccent($string) {
		$marTViet=array(
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
	 * Format date
	 * @param  [type] $time [description]
	 * @return [type]       [description]
	 */
	public static function formatDate($time) {
	   $str = "";
	   $time = intval($time);
	   $now = time();

	   $sub = $now - $time;

      switch($sub) {
        case $sub < 86400: // 1 Ngày
            if( $sub < 60 ) { // Giây
                // $str = 'Cách đây ' . $sub . ' giây trước';
                $str = 'Vừa mới đây';
            } else if( $sub >= 60 && $sub < 3600 ) { // Phút
                // $str = 'Cách đây ' . round($sub / 60) . ' phút trước';
                $str = round($sub / 60) . ' phút trước';
            } else if( $sub >= 3600 && $sub < 86400 ) { // Giờ
                // $str = 'Cách đây ' . round($sub / 3600) . ' giờ trước';
                $str = round($sub / 3600) . ' giờ trước';
            }
            break;
        case $sub <= ( 86400 * 7 ): // 1 tuần
            // $str = 'Cách đây ' . round($sub / 86400) . ' ngày trước';
            $str = round($sub / 86400) . ' ngày trước';
            break;

        case $sub > ( 86400 * 7 ):
            // $str = 'Lúc '. date('g',$time) . 'h' . date('i',$time) . ' ngày ' . date('d/m/Y',$time);
            $str = date('g',$time) . 'h' . date('i',$time) . ' ngày ' . date('d/m/Y',$time);
            break;

      }
	   return $str;
	}

	/**
	 * Check url is youtube
	 * @param  [type] $url [description]
	 * @return [true | false]      [description]
	 */
	public static function checkUrlYoutube($url) {
		$arrayUrl = parse_url($url);
		if(isset($arrayUrl['host'])) {
			switch ($arrayUrl['host']) {
				case 'www.youtube.com':
				case 'youtube.com':
				case 'youtu.be':
					return true;

				default:
					return false;
			}
		}
		return false;
	}
}