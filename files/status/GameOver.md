## Game Over ?

get status by `$chess->gameOver()`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
.
.
.
var_dump($chess->gameOver()); // return TRUE or FALSE
```

### Game Over Rules:
- in Draw, or
- in Checkmate
