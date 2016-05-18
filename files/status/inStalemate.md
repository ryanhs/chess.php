## Stalemate ?

get status by `$chess->inStalemate()`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();

// fen source: https://www.redhotpawn.com/forum/only-chess/interesting-stalemate-position.152109
// start fen : 3b3k/p6p/1p5P/3q4/8/n7/PP6/K4Q2 w - - 0 1
$chess->load('7k/p6p/1p3b1P/3q4/8/n7/PP6/K7 w - - 0 2');

var_dump($chess->inStalemate()); // return TRUE
```
board:
```text
   +------------------------+
 8 | .  .  .  .  .  .  .  k |
 7 | p  .  .  .  .  .  .  p |
 6 | .  p  .  .  .  b  .  P |
 5 | .  .  .  q  .  .  .  . |
 4 | .  .  .  .  .  .  .  . |
 3 | n  .  .  .  .  .  .  . |
 2 | P  P  .  .  .  .  .  . |
 1 | K  .  .  .  .  .  .  . |
   +------------------------+
     a  b  c  d  e  f  g  h
```

![stalemate](http://www.fen-to-image.com/image/7k/p6p/1p3b1P/3q4/8/n7/PP6/K7%20w%20-%20-%200%202 "stalemate")

