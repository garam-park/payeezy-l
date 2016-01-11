<?php namespace Parkgaram\Payeezy\Apis;

use Curl\Curl;

class PayeezyApi {
	
	private $apiKey;
	private $apiSecret;
	private $merchantToken;
	private $baseURL;
	protected $uri;

	public static $URI_SANDBOX = 'https://api-cert.payeezy.com/v1';
	public static $URI_LIVE = 'https://api.payeezy.com/v1';

	public function __construct($apiKey,$apiSecret,$merchantToken) {
		$this->apiKey = $apiKey;
		$this->apiSecret = $apiSecret;
		$this->merchantToken = $merchantToken;
	}

	/**
	 * @param string $uri
	 */
	public function setUri($uri)
	{
	    $this->uri = $uri;
	    return $this;
	}

	public static function processInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return strval($data);
    }

	public function getApiKey(){
		return $this->apiKey;
	}

	public function getApiSecret(){
		return $this->apiSecret;
	}

	public function getMerchantToken(){
		return $this->merchantToken;
	}

	private function post($json,$headers)
	{
		$curl = new Curl();
		$curl->setHeader('Content-Type','application/json');
		$curl->setHeader('apikey',strval($this->apiKey));
		$curl->setHeader('token',strval($this->merchantToken));
		$curl->setHeader('Authorization',$headers['authorization']);
		$curl->setHeader('nonce',$headers['nonce']);
		$curl->setHeader('timestamp',$headers['timestamp']);
    	$curl->post($this->uri,$json);
    	
    	$curl->close();

    	return $curl->response;
	}

	protected function hmac($json)
	{
		$nonce = strval(hexdec(bin2hex(openssl_random_pseudo_bytes(4, $cstrong))));
	    $timestamp = strval(time()*1000); //time stamp in milli seconds
	    
	    $data = 
	    	$this->apiKey . $nonce . $timestamp . $this->merchantToken . $json;

	    $hashAlgorithm = "sha256";
	    $hmac = hash_hmac ($hashAlgorithm , $data , $this->apiSecret, false );    // HMAC Hash in hex
	    $authorization = base64_encode($hmac);
	    return [
	    		'authorization' => $authorization,
	            'nonce' => $nonce,
	            'timestamp' => $timestamp,
	           ]; 
	}

	protected function request($payload)
	{	
		//payload to json
		$json = json_encode($payload, JSON_FORCE_OBJECT);
		//make header
		$headers = $this->hmac($json);
		//request post
		return $this->post($json,$headers);
	}

}
