# Chess.php

chess.php is a PHP chess library that is used for chess move
generation/validation, piece placement/movement, and check/checkmate/stalemate
detection - basically everything but the AI. 

NOTE: this is a port of [chess.js](https://github.com/jhlywa/chess.js) for php

## Coding Style
about coding style, naming system.. 
because this is a PHP, i try to stick to use PHP-PSR, like game_over() become gameOver()  

just keep in mind, any function name transformed into camelCase

## Example Code
The code below plays a complete game of chess ... randomly.

```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
while (!$chess->gameOver()) {
	$moves = $chess->moves();
	$move = $moves[mt_rand(0, count($moves) - 1)];
	$chess->move($move);
}

echo $chess->ascii() . PHP_EOL;
```

## Chess.js
you can check original chess.js [here](https://github.com/jhlywa/chess.js)


## Chess.php documentation

you can check it here: [https://ryanhs.github.io/chess.php](https://ryanhs.github.io/chess.php)

## BUGS

- 

## TODO

- 
