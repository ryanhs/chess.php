## Get all possible moves

to do this, we simply call `$chess->moves();`

it will return all possible moves in SAN format


### SAN

example: 
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
echo json_encode($chess->moves());
```
will output:
```text
["a3","a4","b3","b4","c3","c4","d3","d4","e3","e4","f3","f4","g3","g4","h3","h4","Na3","Nc3","Nf3","Nh3"]
```


### Array

but, if we want to display in array mode, we can pass verbose parameter, example: `$chess->moves(['verbose' => true]);`


example:

```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess();
print_r($chess->moves(['verbose' => true]));
```

will output something like:

```text
Array
(
    [0] => Array
        (
            [color] => w
            [from] => a2
            [to] => a3
            [flags] => n
            [piece] => p
            [san] => a3
        )

    [1] => Array
        (
            [color] => w
            [from] => a2
            [to] => a4
            [flags] => b
            [piece] => p
            [san] => a4
        )

    .
    .
    .
    

    [19] => Array
        (
            [color] => w
            [from] => g1
            [to] => h3
            [flags] => n
            [piece] => n
            [san] => Nh3
        )

)
```


**i use `json_encode()` and `print_r()` for make reading the output easier :-)
