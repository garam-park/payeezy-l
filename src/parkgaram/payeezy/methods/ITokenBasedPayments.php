<?php namespace Parkgaram\Payeezy\Methods;

/**
 * uri https://developer.payeezy.com/tokenbasedpayments/apis/post/transactions
 *
 * @package default
 * @author garam
 */
interface ITokenBasedPayments {
	
	public function authorize($payload);
	public function purchase($payload);
	
}