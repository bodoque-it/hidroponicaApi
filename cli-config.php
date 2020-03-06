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
    'dbname' => getenv("MYSQL_DATABASE"),
    'user' =>  getenv("MYSQL_USER"),
    'password' => getenv("MYSQL_PASSWORD"),
    'host' => getenv("MYSQL_HOST"),
    'driver' => 'pdo_mysql',
);

$em = \Doctrine\ORM\EntityManager::create($conn, $config);

return ConsoleRunner::createHelperSet($em);