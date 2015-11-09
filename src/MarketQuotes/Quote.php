<?php
namespace MarketQuotes;

/**
 * Value of a Company at a point in time
 *
 * @author Maurice Prosper <maurice.prosper@ttu.edu>
 */
class Quote {
	/**
	 * Ref to company this is for
	 * @var Company
	 */
	private $company;
	
	/**
	 * value of quote at this point
	 * @var double
	 */
	private $price;
	
	/**
	 * Temporal Value of quote
	 * @var \DateTime
	 */
	private $timestamp;
	
	/**
	 * Total value of company
	 * @var double
	 */
	private $marketcap;
	
	/**
	 * Total shares
	 * @var int
	 */
	private $volume;
	
	/**
	 * The change in price of the company's stock since the previous trading
	 * day's close
	 * @var double
	 */
	private $change;
	
	/**
	 * The change in price of the company's stock since the start of the year
	 * @var double
	 */
	private $changeYTD;
	
	/**
	 * Highest Value of Company Today
	 * @var double
	 */
	private $high;
	
	/**
	 * Lowest value of company today
	 * @var double
	 */
	private $low;
	
	/**
	 * Value of company at start of day
	 * @var double
	 */
	private $open;	
	
	/**
	 * Search market for recent quote by company symbol
	 * Uses MarketOnDemand
	 * 
	 * @param Company $input
	 * @return Quote
	 */
	public static function lookupRecent(Company $input) {
		$ret = null;
		
		$data = MarketOnDemand::quote($input->getSymbol());
	
		if(is_array($data) && !empty($data)) {
			$ret = new Quote;
			
			$ret->setCompany($input)
				->setPrice( $data['LastPrice'] )
				->setChange( $data['Change'] )
				->setMarketCap( $data['MarketCap'] )
				->setVolume( $data['Volume'] )
				->setChangeYTD( $data['ChangeYTD'] )
				->setHigh( $data['High'] )
				->setLow( $data['Low'] )
				->setOpen( $data['Open'] )
				->setTimestamp( new \DateTime($data['Timestamp']) );
		}
		
		return $ret;
	}
	
	// <editor-fold defaultstate="collapsed" desc="Getters & Setters">


	function getCompany() {
		return $this->company;
	}

	function getPrice() {
		return $this->price;
	}

	function getTimestamp() {
		return $this->timestamp;
	}

	function getMarketcap() {
		return $this->marketcap;
	}

	function getVolume() {
		return $this->volume;
	}

	function getChange() {
		return $this->change;
	}

	function getChangeYTD() {
		return $this->changeYTD;
	}

	function getHigh() {
		return $this->high;
	}

	function getLow() {
		return $this->low;
	}

	function getOpen() {
		return $this->open;
	}

	function setCompany(Company $company) {
		$this->company = $company;
		return $this;
	}

	function setPrice($price) {
		$this->price = $price;
		return $this;
	}

	function setTimestamp(\DateTime $timestamp) {
		$this->timestamp = $timestamp;
		return $this;
	}

	function setMarketcap($marketcap) {
		$this->marketcap = $marketcap;
		return $this;
	}

	function setVolume($volume) {
		$this->volume = $volume;
		return $this;
	}

	function setChange($change) {
		$this->change = $change;
		return $this;
	}

	function setChangeYTD($changeYTD) {
		$this->changeYTD = $changeYTD;
		return $this;
	}

	function setHigh($high) {
		$this->high = $high;
		return $this;
	}

	function setLow($low) {
		$this->low = $low;
		return $this;
	}

	function setOpen($open) {
		$this->open = $open;
		return $this;
	}

// </editor-fold>
}
