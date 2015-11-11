<?php namespace Parkgaram\Payeezy\Method;

interface ICreditCardPayments {

	public function authorize($payload);
	public function purchase($payload);
	public function splitTender($payload);

}