<?php
declare(strict_types=1);

use App\Domain\Container\ContainerRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Container\MySqlContainerRepository;
use App\Infrastructure\Persistence\User\MySqlUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(MySqlUserRepository::class),
        ContainerRepository::class =>\DI\autowire(MySqlContainerRepository::class)
    ]);
};
