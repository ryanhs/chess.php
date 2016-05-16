## Get

get [type, color] from choosen algebraic square, example: `$chess->get('e4');`

#### example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
echo 'FEN => ' . $chess->generateFen() . PHP_EOL;
var_dump($chess->get('e4'), $chess->get('e1'), $chess->get('d8'));
```
will return
```text
FEN => rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1
NULL
array(2) {
  ["type"]=>
  string(1) "k"
  ["color"]=>
  string(1) "w"
}
array(2) {
  ["type"]=>
  string(1) "q"
  ["color"]=>
  string(1) "b"
}
```
