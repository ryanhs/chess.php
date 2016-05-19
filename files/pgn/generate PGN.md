## PGN generation

`$chess->pgn();` can accept 2 options:
- **max_width** for line width (movements)
- **new_line** default "\n"
  
example `$chess->pgn([ 'max_width' => 40, 'new_line' => PHP_EOL ]);`

change `new_line` to `<br/>` and you ready to show PGN in your html pages (y).

### example 1:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess;
echo $chess->pgn(); // return '', since there is no movements or header
```

### example 2:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess;
$chess->header('White', 'John');
$chess->header('Black', 'Cena');
echo $chess->pgn();

/* return something like
[White "John"]
[Black "Cena"]

*/
```

### example 3 (**black move first**):
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess;
$chess->move('e4');
$fen = $chess->fen();

$chess->load($fen); // do setup with black first
$chess->move('e5');
$chess->move('Nf3');
$chess->move('Nc6');

echo $chess->pgn();

/* return something like
[SetUp "1"]
[FEN "rnbqkbnr/pppppppp/8/8/4P3/8/PPPP1PPP/RNBQKBNR b KQkq e3 0 1"]

1. ... e5 2. Nf3 Nc6
*/
```
