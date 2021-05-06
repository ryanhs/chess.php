# Chess.php

`chess.php` is a PHP chess library that is used for chess move
generation/validation, piece placement/movement, and check/checkmate/stalemate
detection - basically everything but the AI.

<b>NOTE: this is a port of [chess.js](https://github.com/jhlywa/chess.js) for php</b>

You can check out the original `chess.js` code [here](https://github.com/jhlywa/chess.js).

[![Latest Stable Version](https://poser.pugx.org/ryanhs/chess.php/v/stable)](https://packagist.org/packages/ryanhs/chess.php)
[![CI](https://github.com/ryanhs/chess.php/actions/workflows/php.yml/badge.svg)](https://github.com/ryanhs/chess.php/actions/workflows/php.yml)
[![MIT License](https://poser.pugx.org/ryanhs/chess.php/license)](https://packagist.org/packages/ryanhs/chess.php)

## Installation
You can install this package by running this command assuming you have composer installed. 
```sh
composer require ryanhs/chess.php
```
If you don't have composer installed you can install it directly from their [website](https://getcomposer.org/).

## Coding Style
`chess.php` follows PSR-2 coding standards. For example a function name like `do_something()` gets transformed into `doSomething()`.
Be sure to correctly indent your code and add comments. Adding comments will help other developers know what a block of code does.
Other then that all contributions are welcomed.

## Basic Usage
Here is a sample code that plays a random game of chess.
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Ryanhs\Chess\Chess;

$chess = new Chess();
while (!$chess->gameOver()) {
    $moves = $chess->moves();
    $move = $moves[mt_rand(0, count($moves) - 1)];
    $chess->move($move);
}

echo $chess->ascii() . PHP_EOL;
```

## Documentation
You can check out the full documentation at [https://ryanhs.github.io/chess.php](https://ryanhs.github.io/chess.php).
