# Chess.php

chess.php is a PHP chess library that is used for chess move
generation/validation, piece placement/movement, and check/checkmate/stalemate
detection - basically everything but the AI. 

NOTE: this is a port of [chess.js](https://github.com/jhlywa/chess.js) for php  

[![Latest Stable Version](https://poser.pugx.org/ryanhs/chess.php/v/stable)](https://packagist.org/packages/ryanhs/chess.php)
[![Build Status](https://travis-ci.org/ryanhs/chess.php.svg?branch=master)](https://travis-ci.org/ryanhs/chess.php)
[![PHP 5.6](http://php-eye.com/badge/symfony/symfony/php56.svg)](http://php.net/)
[![MIT License](https://poser.pugx.org/ryanhs/chess.php/license)](https://packagist.org/packages/ryanhs/chess.php)  

## Installation

use composer with `composer require ryanhs/chess.php`   
or put in your composer.json  
```
"require": {
	"ryanhs/chess.php": "^1.0"
}
```
  
  
if you doesn't know composer, its a really usefull tools in php for package management,   
try to learn composer [here](https://getcomposer.org/doc/00-intro.md)


## Coding Style
about coding style, naming system.. 
because this is a PHP, i try to stick to use PHP-PSR, like game_over() become gameOver()  

just keep in mind, any function name transformed into camelCase

## Example Code
The code below plays a complete game of chess ... randomly.

```php
<?php

require 'vendor/autoload.php';
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

## BACKGROUND

actually i made this, when i need to use some validation in my chess game (college project) haha..  
main purpose is for validation, we not try to make an engine in PHP :-)
