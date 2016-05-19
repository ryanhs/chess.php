## PGN parse

sometimes we need to parse pgn,  
you can use `Chess::parsePgn($pgnString);`


### example simple pgn:
```php
<?php
use \Ryanhs\Chess\Chess;

$parsed = Chess::parsePgn('1.e4 e5 2.Nf3');
print_r($parsed);
```  
output  

```
Array
(
    [header] => Array
        (
        )

    [moves] => Array
        (
            [0] => e4
            [1] => e5
            [2] => Nf3
        )

)
```

### example with some header:
```php
<?php
use \Ryanhs\Chess\Chess;

$parsed = Chess::parsePgn(<<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3
EOD
);
print_r($parsed);
```  
output  

```
Array
(
    [header] => Array
        (
            [Event] => Earl tourn
            [Site] => ?
        )

    [moves] => Array
        (
            [0] => e4
            [1] => e5
            [2] => Nf3
        )

)
```


#### note
this function only parse the pgn not validating it :-)
to validate, please use `Chess::validatePgn($pgn);` function;
