## Square Color ?

get square color by `$chess->squareColor($square);`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();

echo $chess->squareColor('a1') . PHP_EOL; // dark
echo $chess->squareColor('b2') . PHP_EOL; // dark
echo $chess->squareColor('b3') . PHP_EOL; // light
echo $chess->squareColor('e4') . PHP_EOL; // light
echo $chess->squareColor('e5') . PHP_EOL; // dark

echo $chess->squareColor('AA') . PHP_EOL; // null
```

### return
- dark 
- light
- NULL
