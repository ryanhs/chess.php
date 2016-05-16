## remove

remove piece from board, example: `$chess->remove('e4');`

#### example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
$chess->remove('e2');
echo 'FEN => ' . $chess->generateFen() . PHP_EOL;
echo $chess;
```
will return
```text
FEN => rnbqkbnr/pppppppp/8/8/8/8/PPPP1PPP/RNBQKBNR w KQkq - 0 1
   +------------------------+
 8 | r  n  b  q  k  b  n  r |
 7 | p  p  p  p  p  p  p  p |
 6 | .  .  .  .  .  .  .  . |
 5 | .  .  .  .  .  .  .  . |
 4 | .  .  .  .  .  .  .  . |
 3 | .  .  .  .  .  .  .  . |
 2 | P  P  P  P  .  P  P  P |
 1 | R  N  B  Q  K  B  N  R |
   +------------------------+
     a  b  c  d  e  f  g  h
```
