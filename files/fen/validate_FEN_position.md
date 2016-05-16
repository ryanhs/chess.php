## FEN validation

its really simple to validate a fen
but now, its not support all validation in fen, 
let say only structure validation for now.

```php
<?php 
// validate fen
$validation = Chess::validateFen('4rrk1/8/p1pR4/1p6/1PPKNq2/3P1p2/PB5n/R2Q4 b - - 6 40');
var_dump($validation);
```

example result:
```
array(3) {
  ["valid"]=>
  bool(true)
  ["error_number"]=>
  int(0)
  ["error"]=>
  string(10) "No errors."
}
```



#### example - (load fen):
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess;
$chess->load('4rrk1/8/p1pR4/1p6/1PPKNq2/3P1p2/PB5n/R2Q4 b - - 6 40'); // this return true | false
```
