# String Service

Helps with latin string manipulation, without adding dependencies. 
Making code simple, intuitive and work as excepted.

### Encode

Encode with `kebabEncode`, `snakeEncode`, `camelEncode` methods. 

Examples :

```php
use gcob\StringService\StringService;

$input = "  Ma  -chaine##!   PÀS ENcodé     ";

$kebab = StringService::getInstance()->kebabEncode($input);
echo $kebab; // ma-chaine-pas-encode

$snake = StringService::getInstance()->snakeEncode($input);
echo $snake; // ma_chaine_pas_encode

$camel = StringService::getInstance()->camelEncode($input);
echo $camel; // maChainePasEncode
```

### Remove accents

```php
use gcob\StringService\StringService;

$input = "déjà vue";

$noAccents = StringService::getInstance()->removeAccents($input);
echo $noAccents; // deja vue
```
