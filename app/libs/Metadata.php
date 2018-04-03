<?php
use Fsd\Settings\Setting;
class Metadata {
	public $title;
	public $keywords;
	public $description;
	public $owner;
	public $facebook;
	public $twitter;
	public $gplus;
	public $ogImage;
	public $gacode;
	public $phone;
	public $email;
   public $address;
	public $about;

	public function __construct() {
		$setting = Setting::find(1);
		if (!$setting) {
			$setting = (object) Config::get('configuration');
		}

		$this->title 			= $setting->title;
		$this->keywords 		= $setting->keywords;
		$this->description 	= $setting->description;
		$this->owner 			= $setting->owner;
		$this->facebook 		= $setting->facebook;
		$this->twitter 		= $setting->twitter;
		$this->gplus 			= $setting->gplus;
		$this->ogImage       = 'http://waa.vn/assets/img/logo.png';
		$this->gacode  		= $setting->ga_code;
		$this->phone 			= $setting->phone;
		$this->email   		= $setting->email;
      $this->address       = $setting->address;
		$this->about 		   = $setting->about;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getKeywords() {
		return $this->keywords;
	}

	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getOwner() {
		return $this->owner;
	}

	public function setOwner($owner) {
		$this->owner = $owner;
	}

	public function getFacebook() {
		return $this->facebook;
	}

	public function setFacebook($facebook) {
		$this->facebook = $facebook;
	}

	public function getTwitter() {
		return $this->twitter;
	}

	public function setTwitter($twitter) {
		$this->twitter = $twitter;
	}

	public function getGplus() {
		return $this->gplus;
	}

	public function setGplus($gplus) {
		$this->gplus = $gplus;
	}

	public function setOgImage($ogImage) {
		$this->ogImage = $ogImage;
	}

	public function getOgImage() {
		return $this->ogImage;
	}

	public function getGACode(){
		return $this->gacode;
	}

	public function setGAcode($gacode){
		$this->gacode = $gacode;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

   public function getAbout() {
      return $this->about;
   }

   public function setAbout($about) {
      $this->about = $about;
   }
}