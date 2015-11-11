<?php namespace Parkgaram\Payeezy;

class CardPayment implements Payment
{
	/**
	 * @var CardPayment
	 * for singleton
	 */
	private static $instance;
	
	private function __construct()
	{
		//nothing to do;
	}

	/**
	 * Singleton
	 */
	public function getInstance(){
		
		if(!isset($this->instance))
			$this->instance = new CardPayment();

		return $instance;
	}

	public function authorize($payload = []){

	}
	public function purchase($payload = []){
		
	}
}