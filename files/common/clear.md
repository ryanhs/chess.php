## Clear Board

to clear all piece in board, we simply call clear()

#### example
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
$chess->clear();
echo 'FEN => ' . $chess->generateFen() . PHP_EOL;
echo $chess;
```
will return
```
FEN => 8/8/8/8/8/8/8/8 w - - 0 1
   +------------------------+
 8 | .  .  .  .  .  .  .  . |
 7 | .  .  .  .  .  .  .  . |
 6 | .  .  .  .  .  .  .  . |
 5 | .  .  .  .  .  .  .  . |
 4 | .  .  .  .  .  .  .  . |
 3 | .  .  .  .  .  .  .  . |
 2 | .  .  .  .  .  .  .  . |
 1 | .  .  .  .  .  .  .  . |
   +------------------------+
     a  b  c  d  e  f  g  h
```
