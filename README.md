# Compress Cookie

Compress cookies with gzcompress

## Example usage

```
use DavidArendsen\CompressCookie\CompressCookie;

$compresscookie = new CompressCookie;
  
$compresscookie->setcookie('cookie-string', 'This is a string', 3600);
$compresscookie->setcookie('cookie-array', ['This is an array'], 3600);
  
var_dump( $compresscookie->getcookie('cookie-string') );
var_dump( $compresscookie->getcookie('cookie-array') );
```
