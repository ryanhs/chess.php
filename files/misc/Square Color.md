## Square Color ?

get square color by `Chess::squareColor($square);`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

echo Chess::squareColor('a1') . PHP_EOL; // dark
echo Chess::squareColor('b2') . PHP_EOL; // dark
echo Chess::squareColor('b3') . PHP_EOL; // light
echo Chess::squareColor('e4') . PHP_EOL; // light
echo Chess::squareColor('e5') . PHP_EOL; // dark

echo Chess::squareColor('AA') . PHP_EOL; // null
```

### change default light/dark return
example:
```php
<?php
use \Ryanhs\Chess\Chess;

echo Chess::squareColor('a1', 'w', 'b') . PHP_EOL; // b
echo Chess::squareColor('b3', 'w', 'b') . PHP_EOL; // w
```

### return
- dark
- light
- NULL
