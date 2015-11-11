<?php namespace Parkgaram\Payeezy;

/*
 * State Pattern
 */
interface Payment {
	public function authorize($payload = []);
	public function purchase($payload = []);
}
