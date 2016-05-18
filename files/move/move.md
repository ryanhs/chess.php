## Move

there is 2 ways to do a move: move($san) or move($moveArray)

because some GUI or Engine using SAN format but some use another format like [from & to] square

### move($san)

example: `$chess->move('e4');`
```php
<?php
use \Ryanhs\Chess\Chess;

// Ruy Lopez (C70)
$chess = new Chess();
$chess->move('e4');
$chess->move('e5');
$chess->move('Nf3');
$chess->move('Nc6');
$chess->move('Bb5');
$chess->move('a6');
$chess->move('Ba4');
$chess->move('Bc5');

echo $chess . PHP_EOL;
```
will output something like:
```text
   +------------------------+
 8 | r  .  b  q  k  .  n  r |
 7 | .  p  p  p  .  p  p  p |
 6 | p  .  n  .  .  .  .  . |
 5 | .  .  b  .  p  .  .  . |
 4 | B  .  .  .  P  .  .  . |
 3 | .  .  .  .  .  N  .  . |
 2 | P  P  P  P  .  P  P  P |
 1 | R  N  B  Q  K  .  .  R |
   +------------------------+
     a  b  c  d  e  f  g  h
```





### move($moveArray)

in the other hand, sometimes its usefull only to move with array format
example: `$chess->move(['from' => 'e2', 'to' => 'e4']);`

but for something like e7 to e8, it need to promotion right? the format will be something like this:
`$chess->move(['from' => 'e2', 'to' => 'e4', 'promotion' => Chess::QUEEN]);`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

// Ruy Lopez (C70)
$chess = new Chess();
$chess->move(['from' => 'e2', 'to' => 'e4']);
$chess->move(['from' => 'e7', 'to' => 'e5']);
$chess->move(['from' => 'g1', 'to' => 'f3']);
$chess->move(['from' => 'b8', 'to' => 'c6']);
$chess->move(['from' => 'f1', 'to' => 'b5']);
$chess->move(['from' => 'a7', 'to' => 'a6']);
$chess->move(['from' => 'b5', 'to' => 'a4']);
$chess->move(['from' => 'f8', 'to' => 'c5']);

echo $chess . PHP_EOL;
```
will output something like:
```text
   +------------------------+
 8 | r  .  b  q  k  .  n  r |
 7 | .  p  p  p  .  p  p  p |
 6 | p  .  n  .  .  .  .  . |
 5 | .  .  b  .  p  .  .  . |
 4 | B  .  .  .  P  .  .  . |
 3 | .  .  .  .  .  N  .  . |
 2 | P  P  P  P  .  P  P  P |
 1 | R  N  B  Q  K  .  .  R |
   +------------------------+
     a  b  c  d  e  f  g  h
```




### return

after we call `move()` it will return something like this:

``` 
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


**but, if the move is illegal or invalid, then it will return NULL**

