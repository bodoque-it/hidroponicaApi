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
        "db"=> DI\factory(function (ContainerInterface $c){
            $host = getenv("MYSQL_HOST");
            $dbname = getenv("MYSQL_DATABASE");
            $username = getenv("MYSQL_USER");
            $password = getenv("MYSQL_PASSWORD");
            $charset = 'utf8';
            $collate = 'utf8_unicode_ci';
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
            ];

            return new PDO($dsn, $username, $password, $options);
        }),
        "doctrine" => DI\factory(function (ContainerInterface $c){
            $isDevMode = true;
            $path = array(
                 __DIR__ .'/../config/xml' 
            );
            $config = Setup::createXMLMetadataConfiguration($path, $isDevMode);
            $conn = array(
                'dbname' => 'doctrine_h',
                'user' => 'antilef',
                'password' => 'DaVS7a18*',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            );


            return \Doctrine\ORM\EntityManager::create($conn, $config);
        })
    ]);
};
