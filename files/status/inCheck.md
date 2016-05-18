## Check ?

get status by `$chess->inCheck()`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess('some fen here');
var_dump($chess->inCheck()); // return TRUE or FALSE
```
