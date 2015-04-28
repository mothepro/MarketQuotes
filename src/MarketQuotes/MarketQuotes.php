<?php

namespace MarketQuotes;

/**
 * A simple layer of abstraction to get information on the market
 * Uses http://dev.markitondemand.com/ API
 *
 * @author Maurice Prosper <maurice.prosper@ttu.edu>
 * @package MarketQuotes
 */
abstract class MarketQuotes {
	/**
	 * Where we get our data
	 */
	const URL = 'http://dev.markitondemand.com/Api/v2/';

	/**
	 * Fomrat API returns data in
	 */
	const FORMAT = '/json';

	/**
	 * The Rest client
	 * @var \Pest
	 */
	private static $rest;

	/**
	 * Creates the rest client
	 */
	private static function init() {
		if(!isset(self::$rest)) {
			if(self::FORMAT === '/json')
				self::$rest = new \PestJSON(self::URL);
			elseif(self::FORMAT === '/xml')
				self::$rest = new \PestXML(self::URL);
		}
	}

	/**
	 * Search market for symbol or company name
	 * @param string $input
	 * @return Object[]
	 */
	public static function lookup($input) {
		self::init();

		$data = self::$rest->get('Lookup' . self::FORMAT, [
			'input'	=> $input
		]);

		return $data;
	}

	/**
	 * Get most recent quote
	 * @param string $symbol
	 * @return Object
	 */
	public static function quote($symbol) {
		self::init();

		$data = self::$rest->get('Quote' . self::FORMAT, [
			'symbol'	=> $symbol
		]);

		return $data;
	}
}
