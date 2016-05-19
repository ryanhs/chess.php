## PGN load

simply, just use: `$chess->loadPgn($pgnString);`

### example
```php
<?php
use \Ryanhs\Chess\Chess;

$return = $chess->loadPgn('1.e4 e5 2.Nf3'); // return TRUE

$return = $chess->loadPgn('1.e4 e5 invalid PGN 2.Nf3'); // return FALSE


$return = $chess->loadPgn(<<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3
EOD
; // return TRUE

$return = $chess->loadPgn(<<<EOD
[Event "Earl tourn"]
make it invalid
[Site "?"]
1.e4 e5 2.Nf3
EOD
; // return FALSE
```  
