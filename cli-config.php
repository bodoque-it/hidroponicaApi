<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require 'vendor/autoload.php';


// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$path = array(
    __DIR__ .'/config/xml' 
);
$config = Setup::createXMLMetadataConfiguration($path, $isDevMode);
// database configuration parameters
$conn = array(
    'dbname' => 'doctrine_h',
    'user' => 'antilef',
    'password' => 'DaVS7a18*',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$em = \Doctrine\ORM\EntityManager::create($conn, $config);

return ConsoleRunner::createHelperSet($em);