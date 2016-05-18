## Half Moves Exceeded ?

get status by `$chess->halfMovesExceeded()` or `$chess->inHalfMovesExceeded()`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
.
.
.
var_dump($chess->inHalfMovesExceeded()); // return TRUE or FALSE
```
