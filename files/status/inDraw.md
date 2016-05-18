## Draw ?

get status by `$chess->inDraw()`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
.
.
.
var_dump($chess->inDraw()); // return TRUE or FALSE
```

### Draw Rules:
- half moves exceeded (max 100), or
- in stalemate, or
- insufficient material, or
- in three fold repetition

*but not in checkmate :-)
