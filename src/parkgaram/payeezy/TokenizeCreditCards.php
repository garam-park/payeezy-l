<?php namespace Parkgaram\Payeezy;

use Parkgaram\Payeezy\Method\ITokenizeCreditCards;

class TokenizeCreditCards extends PayeezyApi implements ITokenizeCreditCards 
{
	
	public function __construct($apiKey,$apiSecret,$merchantToken) {
		parent::__construct($apiKey,$apiSecret,$merchantToken);
	}

	/**
	 * @return 
	 * @author 
	 */
	public function create($payload = []){
		$this->uri = PayeezyApi::$URI_SANDBOX.'/transactions/tokens';
		$payload = array_merge([
			  "type" => 'FDToken',
			  "auth" => 'false',
			  "ta_token" => 'NOIW',
			  "credit_card" => [
			    "type" => '',
			    "cardholder_name" => '',
			    "card_number" => '',
			    "exp_date" => '',
			    "cvv" => '',
			  ]
			],$payload);
		return parent::request($payload);
	}
}