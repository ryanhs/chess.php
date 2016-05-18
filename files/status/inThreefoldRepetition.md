## Threefold Repetition ?

get status by `$chess->inThreefoldRepetition()`

actually i test use this method with game:
> [Event "World Championship 35th-KK5"]  
> [Site "Lyon/New York"]  
> [Date "1990.??.??"]  
> [Round "16"]  
> [White "Kasparov, Gary"]  
> [Black "Karpov, Anatoly"]  
> [Result "1-0"]  
> [WhiteElo "2800"]  
> [BlackElo "2730"]  
> [ECO "C45"]  


### example
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
.
.
.
var_dump($chess->inThreefoldRepetition()); // return TRUE or FALSE
```
