## Print Board (ASCII)

chess.php like chess.js has built in debuging tools for print board in ascii format
its really simple, just use ascii() method.

#### example 1:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
echo $chess->ascii() . PHP_EOL; // print ascii board
```

#### example 2 with __toString()
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess('some fen goes here');
echo $chess . PHP_EOL; // see the difference?
```
