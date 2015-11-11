<?php
/**
* 
*/
use Parkgaram\Payeezy\PayeezyApi;
use Parkgaram\Payeezy\CreditCardPayments as CardPayments;

class PayeezyTest extends PHPUnit_Framework_TestCase
{
	
	// public function testhelloTest()
 //    {
 //    	$api = new PayeezyApi('1','2');
 //    	$this->assertEquals($api->getApiKey(),'1');
 //    	$this->assertEquals($api->getApiSecret(),'2');

 //        $creditCartPayments->authorize();
 //    }
    
  //   public function testCurl()
  //   {
  //   	$curl = new Curl\Curl();
		// $curl->get('http://httpbin.org/get');

		// var_dump($curl->request_headers);
		// var_dump($curl->response_headers);
  //   }

    public function testCardPayments($value='')
    {
        $cardApi = new CardPayments(
            );

        $payload = [
              "merchant_ref" => PayeezyApi::processInput('adf'),
              "transaction_type" => PayeezyApi::processInput('purchase'),
              "method" => PayeezyApi::processInput('credit_card'),
              "amount" => PayeezyApi::processInput('1'),
              "partial_redemption" => PayeezyApi::processInput('false'),
              "currency_code" => PayeezyApi::processInput('USD'),
              "credit_card" => [
                "type" => PayeezyApi::processInput('visa'),
                "cardholder_name" => PayeezyApi::processInput('John Smith'),
                "card_number" => PayeezyApi::processInput('4788250000028291'),
                "exp_date" => PayeezyApi::processInput('1020'),
                "cvv" => PayeezyApi::processInput('123'),
              ]
        ];
        
        $response = $cardApi->purchase($payload);
        var_dump($response);
    }
}
