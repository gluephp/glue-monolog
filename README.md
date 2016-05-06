# Monolog for Glue

Use [Monolog](https://github.com/Seldaek/monolog) with [gluephp/glue](https://github.com/gluephp/glue)

## Installation

Use [Composer](http://getcomposer.org):

```bash
$ composer require gluephp/glue-monolog
```

## Configure Monolog

```php
$app = new Glue\App;

$app->config->override([
    'monolog' => [
        'folder'    => '/absolute/path/to/log/folder',
        'file'      => 'log_' . date('Ymd') . '.log',
        'level'     => 'error' // PSR-3 logging level
    ],
]);
```

## Register Monolog

```php
$app->register(
    new Glue\Monolog\ServiceProvider()
);
```

## Get the Monolog instance

Once the service provider is registered, you can fetch the Monolog instance with:

```php
$monolog = $app->make('Monolog\Logger');
```
or since Monolog implements the PSR interface:
```php
$monolog = $app->make('Psr\Log\LoggerInterface');
```
or use the alias:
```php
$monolog = $app->log;
```
