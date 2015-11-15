<?php
/**
* 
*/
use Parkgaram\Payeezy\Apis\PayeezyApi;
use Parkgaram\Payeezy\Apis\CreditCardPayments as CardPayments;
use Parkgaram\Payeezy\Apis\TokenizeCreditCards;
use Parkgaram\Payeezy\Apis\TokenBasedPayments;

class PayeezyTest extends PHPUnit_Framework_TestCase
{
    
    protected $apiKey        = 'G2hk6Rf0wnHXo3bHBP1LKXL1uOtZp5Vm';
    protected $apiSecret     = '5ef458ab58dbb62693f0de958802e37e29df7d674092489c5d833987a5c8e937';
    protected $merchantToken = 'fdoa-a480ce8951daa73262734cf102641994c1e55e7cdf4c02b6';
    
    /**
     * @test
     */
    public function cardPayments($value='')
    {
        $cardApi = new CardPayments(
          $this->apiKey,
          $this->apiSecret,
          $this->merchantToken);

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
        $decodedResp = json_decode($response, true);

        $this->assertEqualsStep($decodedResp);


    }

    /**
     * @test
     */
    public function createAndPaymentsWithToken()
    {
      $api = new TokenizeCreditCards(
        $this->apiKey,
        $this->apiSecret,
        $this->merchantToken);

      $payload = [
        "type" => PayeezyApi::processInput('FDToken'),
        "auth" => PayeezyApi::processInput('false'),
        "ta_token" => PayeezyApi::processInput('NOIW'),
        "credit_card" => [
          "type" => PayeezyApi::processInput('visa'),
          "cardholder_name" => PayeezyApi::processInput('John Smith'),
          "card_number" => PayeezyApi::processInput('4788250000028291'),
          "exp_date" => PayeezyApi::processInput('1020'),
          "cvv" => PayeezyApi::processInput('123'),
        ]
      ];
      
      $response = $api->create($payload);
      $decodedResp = json_decode($response, true);

      // $this->assertEqualsStep($decodedResp);

      $api = new TokenBasedPayments(
        $this->apiKey,
        $this->apiSecret,
        $this->merchantToken);


      $payload = [
        'merchant_ref' =>  'TEST ref 110',
        'transaction_type'=>  'authorize',
        'method' =>  'token',
        'amount' =>  '1',
        'currency_code' =>  'USD',
        'token' => [
          'token_type' => 'FDToken',
          'token_data' => [
            'type' =>  $decodedResp['token']['type'],
            'value' =>  $decodedResp['token']['value'],
            'cardholder_name' => $decodedResp['token']['cardholder_name'],
            'exp_date' => $decodedResp['token']['exp_date'],
        ]]];

      $response = $api->authorize($payload);
      $decodedResp = json_decode($response, true);
      
      $this->assertEqualsStep($decodedResp);
    }


    private function assertEqualsStep($arr = [])
    {
      $this->assertEquals(
        'approved', 
        $arr['transaction_status']
      );//$this->assertEquals(

      // "validation_status":"success",
      $this->assertEquals(
        'success', 
        $arr['validation_status']
      );//$this->assertEquals(
    }
}
