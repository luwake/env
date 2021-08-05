# env
a .env file read class use php function parse_ini_file


# example

```php
$env = new DotEnv(__DIR__ . '/.env');

$env->load(__DIR__ . '/.other.env');

$env->set('APP_NAME', 'TEST');

$env->get('APP_NAME');

getenv('APP_NAME');
```
