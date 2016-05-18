## Insufficient Material ?

get status by `$chess->insufficientMaterial()`

### k vs k
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
$chess->clear();
$chess->put(['type' => Chess::KING, 'color' => Chess::WHITE], 'e1');
$chess->put(['type' => Chess::KING, 'color' => Chess::BLACK], 'e8');
var_dump($chess->insufficientMaterial()); // true
```

### k vs kn
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
$chess->clear();
$chess->put(['type' => Chess::KING, 'color' => Chess::WHITE], 'e1');
$chess->put(['type' => Chess::KING, 'color' => Chess::BLACK], 'e8');
$chess->put(['type' => Chess::KNIGHT, 'color' => Chess::WHITE], 'e4');
var_dump($chess->insufficientMaterial()); // true
```

### k vs kb
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
$chess->clear();
$chess->put(['type' => Chess::KING, 'color' => Chess::WHITE], 'e1');
$chess->put(['type' => Chess::KING, 'color' => Chess::BLACK], 'e8');
$chess->put(['type' => Chess::BISHOP, 'color' => Chess::WHITE], 'e4');
var_dump($chess->insufficientMaterial()); // true
```

### k vs k(b){0,} << bishop(s) in same color
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
$chess->clear();
$chess->put(['type' => Chess::KING, 'color' => Chess::WHITE], 'e1');
$chess->put(['type' => Chess::KING, 'color' => Chess::BLACK], 'e8');
$chess->put(['type' => Chess::BISHOP, 'color' => Chess::BLACK], 'e5');
var_dump($chess->insufficientMaterial()); // true

$chess->put(['type' => Chess::BISHOP, 'color' => Chess::BLACK], 'd6');
var_dump($chess->insufficientMaterial()); // true

$chess->put(['type' => Chess::BISHOP, 'color' => Chess::BLACK], 'c7');
var_dump($chess->insufficientMaterial()); // true

$chess->put(['type' => Chess::BISHOP, 'color' => Chess::BLACK], 'b8');
var_dump($chess->insufficientMaterial()); // true

/*
   +------------------------+
 8 | .  b  .  .  k  .  .  . |
 7 | .  .  b  .  .  .  .  . |
 6 | .  .  .  b  .  .  .  . |
 5 | .  .  .  .  b  .  .  . |
 4 | .  .  .  .  .  .  .  . |
 3 | .  .  .  .  .  .  .  . |
 2 | .  .  .  .  .  .  .  . |
 1 | .  .  .  .  K  .  .  . |
   +------------------------+
     a  b  c  d  e  f  g  h
*/

```
