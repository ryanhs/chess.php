## FEN load

just use `$chess->load('fen string');`

example:
```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess;
$chess->load('some fen string');
```

or maybe you want load it in the first place ? (constructor)

```php
<?php
use \Ryanhs\Chess\Chess;

$chess = new Chess('some fen string');
```
