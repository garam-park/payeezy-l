<?php namespace Parkgaram\Payeezy;

class PayeezyApi {
	
	private $apiKey;
	private $apiSecret;
	private $merchantToken;
	private $baseURL;
	private $url;
	/**
	 * @var Parkgaram\Payeezy\Payment
	 */
	private $payment;

	public function __construct($apiKey,$apiSecret,$merchantToken = '') {
		$this->apiKey = $apiKey;
		$this->apiSecret = $apiSecret;
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

	private function post($request = [])
	{

	}

}