# env
a .env file read class


# example

```php
$env = new DotEnv(__DIR__ . '/.env');

$env->load(__DIR__ . '/.other.env');

$env->set('APP_NAME', 'TEST');

$env->get('APP_NAME');

getenv('APP_NAME')
```
