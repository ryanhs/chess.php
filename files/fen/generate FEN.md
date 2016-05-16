## FEN generation

as simple as it should be :-)

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess;
.
.
.
echo $chess->fen() . PHP_EOL;
```

or maybe somehow its more convenient to use alias `$chess->generateFen()`
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess;
.
.
.
echo $chess->generateFen() . PHP_EOL;
```
