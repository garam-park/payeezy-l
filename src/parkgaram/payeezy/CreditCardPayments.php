<?php namespace Parkgaram\Payeezy;

use Parkgaram\Payeezy\Method\ICreditCardPayments;

class CreditCardPayments extends PayeezyApi implements ICreditCardPayments {
	
	public function __construct($apiKey,$apiSecret,$merchantToken) {
		parent::__construct($apiKey,$apiSecret,$merchantToken);
	}

	public function authorize($payload){
		#code ....
	}

	/**
	 * summary
	 *
	 * @return string response from payeezy api
	 * @author garam
	 */
	public function purchase($payload){
		$this->uri = PayeezyApi::$URI_SANDBOX.'/transactions';
		$payload = array_merge([
			  "merchant_ref" => '',
			  "transaction_type" => 'purchase',
			  "method" => 'credit_card',
			  "amount" => '',
			  "partial_redemption" => 'false',
			  "currency_code" => 'USD',
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

	public function splitTender($payload){
		#code ....
	}
}