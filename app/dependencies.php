<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use function DI\get;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');

            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        "doctrine" => DI\factory(function (ContainerInterface $c){
            $isDevMode = true;
            $path = array(
                 __DIR__ .'/../config/xml' 
            );
            $config = Setup::createXMLMetadataConfiguration($path, $isDevMode);
            $conn = array(
                'dbname' => getenv("MYSQL_DATABASE"),
                'user' =>  getenv("MYSQL_USER"),
                'password' => getenv("MYSQL_PASSWORD"),
                'host' => getenv("MYSQL_HOST"),
                'driver' => 'pdo_mysql',
            );


            return \Doctrine\ORM\EntityManager::create($conn, $config);
        })
    ]);
};
