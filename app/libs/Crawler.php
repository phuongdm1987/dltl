<?php
class Crawler{

	public static function parseUrl($url){
		return parse_url($url,  PHP_URL_HOST);
	}
}