## Put

put need 2 parameter:  an array of [type, color] and algebraic square, example: `$chess->put($piece, 'e4');`

*type is case insensitive

#### example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess('8/8/8/8/8/8/8/8 w KQkq - 0 1');
$chess->put(['type' => 'K', 'color' => Chess::BLACK], 'e5');
$chess->put(['type' => 'Q', 'color' => Chess::WHITE], 'e4');
echo 'FEN => ' . $chess->generateFen() . PHP_EOL;
echo $chess;
```
will return
```text
FEN => 8/8/8/4k3/4Q3/8/8/8 w KQkq - 0 1
   +------------------------+
 8 | .  .  .  .  .  .  .  . |
 7 | .  .  .  .  .  .  .  . |
 6 | .  .  .  .  .  .  .  . |
 5 | .  .  .  .  k  .  .  . |
 4 | .  .  .  .  Q  .  .  . |
 3 | .  .  .  .  .  .  .  . |
 2 | .  .  .  .  .  .  .  . |
 1 | .  .  .  .  .  .  .  . |
   +------------------------+
     a  b  c  d  e  f  g  h

```
