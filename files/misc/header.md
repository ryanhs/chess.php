## Header ?

### Set Header

But while chess.js support something like `chess.header('White', 'Morphy', 'Black', 'Anderssen', 'Date', '1858-??-??');`  
in chess.php we not support it :-)  
just simple set header or get it.

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess->header('Site', 'http://cai-itb.dev');
$chess->header('Event', 'AI Training');
```  
  
### Get Headers

you can get headers with `$chess->header();`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess->header('White', 'John');
$chess->header('Black', 'Cena');
$chess->header('Result', '1-0');

print_r($chess->header());
```
return:
```
Array
(
    [White] => John
    [Black] => Cena
    [Result] => 1-0
)
```
