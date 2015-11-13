<?php namespace Parkgaram\Payeezy\Method;

/**
 * uri https://developer.payeezy.com/creditcardpayment/apis/post/transactions
 *
 * @package default
 * @author garam
 */
interface ICreditCardPayments {

	public function authorize($payload);
	public function purchase($payload);
	public function splitTender($payload);

}