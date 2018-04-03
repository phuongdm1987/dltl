<?php namespace Fsd\OAuth;

use Fsd\OAuth\OAuthConsumerServiceFactory;
use OAuth;

class OAuthLogin
{
	protected $consumer = '';
	protected $consumer_service = '';

	public function __construct($consumer)
	{
		$this->consumer = $consumer;
	}

	public function login()
	{

		$this->consumer_service = OAuthConsumerServiceFactory::build($this->consumer);
		// get data from input
		$code = \Input::get( 'code' );

		// get consumer service
		$OAuth = \OAuth::consumer( $this->consumer_service->getConsumer() );

		// check if code is valid

		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {

		  // This was a callback request from consumer, get the token
		  $token = $OAuth->requestAccessToken( $code );

		  // Send a request with it
		  $result = json_decode( $OAuth->request( $this->consumer_service->getRequest() ), true );
		  $email  = $result[$this->consumer_service->getKeyResult()];

        $user = \User::where('email', '=', $email)->first();

        if(!is_null($user)) {
        		\Sentry::loginAndRemember($user, true);
        		$url_redirect = route('author.view', array($user->id, $user->username));
	  			return \Redirect::to($url_redirect);
        } else {

				$token_email = base64_encode(md5($email . time() . getenv('SECRET_STRING')));
				$url = "/auth/signup-oauth?email=" . $email . "&time=" . time() . "&type=" . $this->consumer_service->getTypeSignup() . "&token=" . $token_email;

				return \Redirect::to($url);
        }

		}
		// if not ask for permission first
		else {
		  // get authorization
		  $url = $OAuth->getAuthorizationUri();
		  // return to login url
		  return \Redirect::to( (string)$url );
		}
	}
}