# Compress Cookie

## Example usage

```
$compresscookie = new CompressCookie;
$compresscookie->setcookie('cookie-string', 'This is a string');
$compresscookie->setcookie('cookie-array', ['This is an array']);

var_dump( $compresscookie->getcookie('cookie-string') );
var_dump( $compresscookie->getcookie('cookie-array') );
```
