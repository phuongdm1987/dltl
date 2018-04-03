<?php

namespace Libs;

use Config;
use Image;
use Exception;

/**
 * Class thực thi và cấu hình việc upload, resize ảnh
 *
 * @author Cong Luong <cong.itsoft@gmail.com>
 *
 * ex: $uploadService = new UploadService;
 *
 * $resultUpload = $uploadService->uploadImageProduct($fileControl)
 */
class UploadService extends Image {

	protected $logFileName = 'upload_service';

	public function __construct() {
		$this->config = Config::get('configuration');

		/**
		 * Cấu hình tên hàm và các tham số cần thiết cho việc upload, resize ảnh
		 * function_name => array('path' => $path, 'config_thumbs' => $config_thumbs)
		 */
		$this->mapping = array(
         'uploadCoverUser' => array(
            'path' => PATH_UPLOAD_USER_COVER,
            'config_thumbs' => $this->config['array_crop_cover']
         ),
         'uploadAvatarUser' => array(
            'path' => PATH_UPLOAD_USER_AVATAR,
            'config_thumbs' => $this->config['array_crop_avatar']
         ),
         'uploadImageCity' => array(
            'path' => PATH_UPLOAD_IMAGE_CITY,
            'config_thumbs' => $this->config['array_resize_image']
         ),
         'uploadImageBanner' => array(
            'path' => PATH_UPLOAD_BANNER,
            'config_thumbs' => array()
         ),
         'uploadImageUser' => array(
            'path' => PATH_UPLOAD_USER_AVATAR,
            'config_thumbs' => $this->config['array_resize_image']
         ),
         'uploadImageTheme' => array(
            'path' => PATH_UPLOAD_IMAGE_THEME,
            'config_thumbs' => $this->config['array_resize_image']
         ),
         'uploadImagePost' => array(
            'path' => PATH_UPLOAD_IMAGE_POST,
            'config_thumbs' => $this->config['array_resize_image']
         ),
         'uploadLogoSetting' => array(
            'path' => PATH_UPLOAD_IMAGE_SETTING,
            'config_thumbs' => $this->config['array_resize_image']
         ),
         'uploadImageTour' => array(
         	'path' => PATH_UPLOAD_IMAGE_TOUR,
            'config_thumbs' => $this->config['array_resize_image']
      	),
         'uploadImageCity' => array(
            'path' => PATH_UPLOAD_IMAGE_CITY,
            'config_thumbs' => $this->config['array_resize_image']
         ),
         'uploadImageCountry' => array(
            'path' => PATH_UPLOAD_IMAGE_COUNTRY,
            'config_thumbs' => $this->config['array_resize_image']
         ),
      	'uploadImagePlace' => array(
      		'path' => PATH_UPLOAD_IMAGE_PLACE,
            'config_thumbs' => $this->config['array_resize_image']
   		)
		);
	}

	public function doUpload($formControl, $pathUpload, $configThumbSize, $action, $multi = false) {
		if(!$multi) {
			$resultUpload = $this->upload($formControl, $pathUpload, $configThumbSize, $action);

			// Write log if can not upload success
			if($resultUpload['status'] == 0) {
				$errors = array_merge_recursive($this->getErrors(), $resultUpload);
				logs($this->logFileName, json_encode($errors, JSON_UNESCAPED_UNICODE));
			}
			return $this->response($resultUpload);
		}else{
			$resultUpload = $this->uploadMulti($formControl, $pathUpload, $configThumbSize, $action);
			return $resultUpload;
		}

	}

	public function response($resultUpload) {
		$resultUpload['errors'] = $this->getErrors();
		return $resultUpload;
	}


	/**
	 * Convert errors to html
	 *
	 * @author Cong Luong <cong.itsoft@gmail.com>
	 *
	 * @return mixed
	 */
	public function errorsToHtml() {
		$errors = $this->getErrors();
		if($errors) {
			$html = '<ul class="ct-upload-error">';
			foreach($errors as $err) {
				$htm .= '<li class="cti-uerror">'. $err .'</li>';
			}
			$html .= '</ul>';

			return $html;
		}

		return null;
	}

	public function __call($method, $params) {

		if( array_key_exists($method, $this->mapping) ) {

			// Form control
			if( !isset($params[0]) ) {
				throw new Exception('Missing $formControl param . '. $method .'($formControl, $action)');
			}

			// Action
			if( !isset($params[1]) ) {
				$params[1] = 'resize';
			}

			// Multi ?
			if( !isset($params[2]) ) {
				$params[2] = false;
			}

			$_params = array($params[0], $this->mapping[$method]['path'], $this->mapping[$method]['config_thumbs'], $params[1], $params[2]);

			return call_user_func_array(array($this, 'doUpload'), $_params);

		} else {

			throw new Exception("Method $method is not exits in " . get_class($this));
		}
	}

}