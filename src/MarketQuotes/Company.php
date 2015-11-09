<?php
namespace MarketQuotes;

/**
 * A Punlic company listed on an exchange
 *
 * @author Maurice Prosper <maurice.prosper@ttu.edu>
 */
class Company {
	/**
	 * Ticker Symbol
	 * @var string
	 */
	private $symbol;
	
	/**
	 * Full name
	 * @var string
	 */
	private $name;
	
	/**
	 * Exchange code
	 * @var string
	 */
	private $exchange;
	
	/**
	 * List of available quotes
	 * @var Quote[];
	 */
	private $quotes;
	
	/**
	 * Search market for symbol or company name
	 * Uses MarketOnDemand
	 * 
	 * @param string $tag
	 * @return Company[]
	 */
	public static function lookup($tag) {
		$ret = array();
		$data = MarketOnDemand::lookup($tag);
	
		if(is_array($data) && !empty($data))
			foreach ($data as $comp) {
				$tmp = new Company;
				
				$tmp->setExchange( $comp['Exchange'] )
					->setName( $comp['Name'] )
					->setSymbol( $comp['Symbol'] );
				
				$ret[] = $tmp;
			}
		
		return $ret;
	}
	
	
	/**
	 * Finds most recent quote for company
	 * then adds quote to the company's list
	 * @return \MarketQuotes\Quote
	 */
	public function getRecentQuote() {
		$quote = Quote::lookupRecent($this);
		
		if($quote instanceof Quote)
			$this->addQuote ($quote);
		
		return $quote;
	}
	
	// <editor-fold defaultstate="collapsed" desc="Getters & Setters">


	function getSymbol() {
		return $this->symbol;
	}

	function getName() {
		return $this->name;
	}

	function getExchange() {
		return $this->exchange;
	}

	function getQuotes() {
		return $this->quotes;
	}

	function setSymbol($symbol) {
		$this->symbol = $symbol;
		return $this;
	}

	function setName($name) {
		$this->name = $name;
		return $this;
	}

	function setExchange($exchange) {
		$this->exchange = $exchange;
		return $this;
	}

	function setQuotes(array $quotes) {
		$this->quotes = $quotes;
		return $this;
	}

	function addQuote(Quote $quote) {
		$this->quotes[] = $quote;
		$this->sortQuotes();
		return $this;
	}

// </editor-fold>

	/**
	 * Order Quotes from oldest to newest
	 */
	private function sortQuotes() {
		usort($this->quotes, function (Quote $a, Quote $b) {
			if($a->getTimestamp() === $b->getTimestamp())
				return 0;

			$interval = $a->getTimestamp()->diff($b->getTimestamp());
			return $interval->invert ? 1 : -1;
		});
	}
}
