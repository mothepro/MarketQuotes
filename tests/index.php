<?php require '../vendor/autoload.php'; ?>

Stock Lookup [apple]
<pre>
	<?php var_dump(require 'MoD_lookup.php'); ?>
</pre>

<hr>

Stock Lookup [AAPL]
<pre>
	<?php var_dump(require 'MoD_quote.php'); ?>
</pre>

<hr>

Stock Lookup [IBM] & add quote
<pre>
	<?php var_dump(require 'lookupRecent.php'); ?>
</pre>

<hr>