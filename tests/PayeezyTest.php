<?php
/**
* 
*/
use Parkgaram\Payeezy\PayeezyApi;

class PayeezyTest extends PHPUnit_Framework_TestCase
{
	
	public function testhelloTest()
    {
    	$api = new PayeezyApi('1','2');
    	$this->assertEquals($api->getApiKey(),'1');
    	$this->assertEquals($api->getApiSecret(),'2');
    }
}
?>