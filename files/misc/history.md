## History ?

get square color by `$chess->history();`

### default
example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess->reset();
$match = '1. e4 e6 2. d4 d5 3. Nc3 Nf6 4. Bg5 dxe4 5. Nxe4 Be7 6. Bxf6
		gxf6 7. g3 f5 8. Nc3 Bf6';
$moves = preg_replace("/([0-9]{0,})\./", "", $match);
$moves = str_replace("\r", ' ', str_replace("\n", ' ', str_replace("\t", '', $moves)));
while (strpos($moves, '  ') !== FALSE) $moves = str_replace('  ', ' ', $moves);
$moves = explode(' ', trim($moves));
foreach ($moves as $move) if($chess->move($move) === null) var_dump($move);

echo json_encode($chess->history()) . PHP_EOL;
```
return:
```
["e4","e6","d4","d5","Nc3","Nf6","Bg5","dxe4","Nxe4","Be7","Bxf6","gxf6","g3","f5","Nc3","Bf6"]
```
  
  
  
### verbose

you can get move in detailed mode using verbose parameter `$chess->history([ 'verbose' => true ]);`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess->reset();
.
.
.
print_r($chess->history([ 'verbose' => true ])) . PHP_EOL;
```
return:
```
Array
(
    [0] => Array
        (
            [turn] => w
            [color] => w
            [from] => e2
            [to] => e4
            [flags] => b
            [piece] => p
            [promotion] => 
            [san] => e4
        )
    .
    .
    .
    [15] => Array
        (
            [turn] => b
            [color] => b
            [from] => e7
            [to] => f6
            [flags] => n
            [piece] => b
            [promotion] => 
            [san] => Bf6
        )

)
```
