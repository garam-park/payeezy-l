<?php namespace Parkgaram\Payeezy\Method;

/**
 * uri https://developer.payeezy.com/tokenizedtreditcardpost/apis/post/transactions/tokens-1
 *
 * @package default
 * @author garam
 */
interface ITokenizeCreditCards {
	public function create($params = []);
}