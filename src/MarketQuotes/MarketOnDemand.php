<?php

namespace MarketQuotes;

/**
 * A simple layer of abstraction to get information on the market
 * Uses http://dev.markitondemand.com/ API
 *
 * @TODO http://www.bloomberg.com/markets/chart/data/1D/AAPL:US
 *
 * @author Maurice Prosper <maurice.prosper@ttu.edu>
 * @package MarketQuotes
 */
abstract class MarketOnDemand {
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
		if(!isset(self::$rest))
			switch(self::FORMAT) {
			case '/json':
			default:
				self::$rest = new \PestJSON(self::URL);
				break;
			
			case '/xml':
				self::$rest = new \PestXML(self::URL);
				break;
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
