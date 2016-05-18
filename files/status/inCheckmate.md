## Checkmate ?

get status by `$chess->inCheckmate()`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess('r1bqk1nr/pppp1Qpp/2n5/2b1p3/2B1P3/8/PPPP1PPP/RNB1K1NR b KQkq - 0 4');
var_dump($chess->inCheckmate()); // return TRUE
```
board:
```text
   +------------------------+
 8 | r  .  b  q  k  .  n  r |
 7 | p  p  p  p  .  Q  p  p |
 6 | .  .  n  .  .  .  .  . |
 5 | .  .  b  .  p  .  .  . |
 4 | .  .  B  .  P  .  .  . |
 3 | .  .  .  .  .  .  .  . |
 2 | P  P  P  P  .  P  P  P |
 1 | R  N  B  .  K  .  N  R |
   +------------------------+
     a  b  c  d  e  f  g  h
```

![checkmate](http://www.fen-to-image.com/image/r1bqk1nr/pppp1Qpp/2n5/2b1p3/2B1P3/8/PPPP1PPP/RNB1K1NR%20b%20KQkq%20-%200%204 "checkmate")
