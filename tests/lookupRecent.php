<?php
// IBM list
$ibms = \MarketQuotes\Company::lookup('IBM');

// first IBM
$ibms[0]->getRecentQuote();

return $ibms;
