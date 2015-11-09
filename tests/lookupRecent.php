<?php
$ibm = \MarketQuotes\Company::lookup('IBM');
$ibm->getRecentQuote();

return $ibm;
