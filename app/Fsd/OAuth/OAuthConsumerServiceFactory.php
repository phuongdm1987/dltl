<?php namespace Fsd\OAuth;

class OAuthConsumerServiceFactory
{
	public static function build ($type = '') {

		if($type == '') {
			throw new \Exception('Invalid Consumer Type.');
		} else {
			$className = '\Fsd\OAuthService\\' . ucfirst($type) . 'Service';
		}

		// Assuming Class files are already loaded using autoload concept
		if(class_exists($className)) {
		   return new $className();
		} else {
		   throw new \Exception('Consumer service not found.');
		}
	}
}