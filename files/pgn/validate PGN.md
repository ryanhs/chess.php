## PGN validation

when i start learn pgn, fen, etc.. i wonder if i can make sure all pgn i have is valid
then this function really serve that purpose, but unfortunately there is so much pgn hahaha,  

you can use `Chess::validatePgn($pgnString);`


### example simple pgn:
```php
<?php
use \Ryanhs\Chess\Chess;

$parsed = Chess::validatePgn('1.e4 e5 2.Nf3'); // return TRUE
```  


### example with some header:
```php
<?php
use \Ryanhs\Chess\Chess;

$parsed = Chess::validatePgn(<<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3
EOD
);

// return TRUE
```  

### verbose mode

for richer return, you can pass verbose parameter like other "verboseable" function in chess.php  
example: `$parsed = Chess::validatePgn('1.e4 e5 2.Nf3', [ 'verbose' => true ]);`

it will return something like `Chess::parsedPgn($pgn)` when pgn is valid,  
but return FALSE when its invalid  

example: 

```php
<?php
use \Ryanhs\Chess\Chess;

$parsed = Chess::validatePgn(<<<EOD
[Event "Earl tourn"]
[Site "?"]
1.e4 e5 2.Nf3
EOD
);
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

    [game] => << object of Chess with move after validation, a shortcut for loadPgn :-p
)
```

#### note
verbose or not, if pgn is invalid, this function return FALSE :-)
