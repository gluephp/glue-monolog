<?php namespace Glue\Monolog;

use Glue\App;
use Glue\Interfaces\ServiceProviderInterface;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(App $glue)
    {
        #if (!$glue->config->exists('monolog.path')) {
        #    // No log path set
        #    return;
        #}

        $glue->singleton('Monolog\Logger', function($glue) {
            $logLevel   = $glue->config->get('monolog.level', Logger::ERROR);
            $logLevel   = Logger::toMonologLevel($logLevel);

            $folder     = $glue->config->get('monolog.folder');
            $filename   = $glue->config->get('monolog.file', 'app.log');

            // create a log channel
            $log = new Logger($glue->config->get('monolog.name', 'glue'));
            $log->pushHandler(new StreamHandler(
                $folder . '/' . $filename,
                $logLevel
            ));

            return $log;
        });

        $glue->singleton('Psr\Log\LoggerInterface', 'Monolog\Logger');
        $glue->alias('Monolog\Logger', 'log');

    }
}