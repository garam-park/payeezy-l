<?php namespace Parkgaram\Payeezy\Apis;

use Parkgaram\Payeezy\Methods\ITokenBasedPayments;

class TokenBasedPayments extends PayeezyApi implements ITokenBasedPayments 
{
	
	public function __construct($apiKey,$apiSecret,$merchantToken) {
		parent::__construct($apiKey,$apiSecret,$merchantToken);
	}


	public function authorize($payload)
	{
		$this->uri = PayeezyApi::$URI_SANDBOX.'/transactions';

		$payload = array_merge([
			  'merchant_ref' =>  '',
			  'transaction_type'=>  'authorize',
			  'method' =>  'token',
			  'amount' =>  '',
			  'currency_code' =>  'USD',
			  'token' => [
			    'token_type' => 'FDToken',
			    'token_data' => [
			      'type' =>  '',
			      'value' =>  '',
			      'cardholder_name' => '',
			      'exp_date' => '',
			    ]
			  ]
			],$payload);
		return parent::request($payload);
	}

	public function purchase($payload)
	{

	}
	
}