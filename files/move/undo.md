## Undo :-p

yeah i know, not complete without "undo" right? haha

simply: `$chess->undo();`

```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();

// do a move
$chess->move('e4');
echo $chess;

// undo again
$chess->undo();
echo $chess;
```

will output something like:

```text
// after e4
   +------------------------+
 8 | r  n  b  q  k  b  n  r |
 7 | p  p  p  p  p  p  p  p |
 6 | .  .  .  .  .  .  .  . |
 5 | .  .  .  .  .  .  .  . |
 4 | .  .  .  .  P  .  .  . |
 3 | .  .  .  .  .  .  .  . |
 2 | P  P  P  P  .  P  P  P |
 1 | R  N  B  Q  K  B  N  R |
   +------------------------+
     a  b  c  d  e  f  g  h
     
// afer undo
   +------------------------+
 8 | r  n  b  q  k  b  n  r |
 7 | p  p  p  p  p  p  p  p |
 6 | .  .  .  .  .  .  .  . |
 5 | .  .  .  .  .  .  .  . |
 4 | .  .  .  .  .  .  .  . |
 3 | .  .  .  .  .  .  .  . |
 2 | P  P  P  P  P  P  P  P |
 1 | R  N  B  Q  K  B  N  R |
   +------------------------+
     a  b  c  d  e  f  g  h
```



### return
undo will return NULL if undo failed

```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
$chess->undo(); // return NULL
```

otherwise it return some array move like:
```text
array(6) {
  ["color"]=>
  string(1) "w"
  ["from"]=>
  string(2) "e2"
  ["to"]=>
  string(2) "e4"
  ["flags"]=>
  string(1) "b"
  ["piece"]=>
  string(1) "p"
  ["san"]=>
  string(2) "e4"
}
```

