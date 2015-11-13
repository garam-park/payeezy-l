<?php
/**
* 
*/
use Parkgaram\Payeezy\Apis\PayeezyApi;
use Parkgaram\Payeezy\Apis\CreditCardPayments as CardPayments;
use Parkgaram\Payeezy\Apis\TokenizeCreditCards;

class PayeezyTest extends PHPUnit_Framework_TestCase
{
    
    protected $apiKey        = '';
    protected $apiSecret     = '';
    protected $merchantToken = '';
    
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
        
        var_dump($payload);
        $response = $cardApi->purchase($payload);
        var_dump($response);
    }

    /**
     * @test
     */
    public function createToken()
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
        var_dump($payload);
        $response = $api->create($payload);
        var_dump($response);
    }
}
