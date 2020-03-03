<?php
declare(strict_types=1);

use App\Domain\Container\ContainerRepository;
use App\Domain\Rail\RailRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Container\MySqlContainerRepository;
use App\Infrastructure\Persistence\User\MySqlUserRepository;
use App\Infrastructure\Persistence\Rail\MySqlRailRepository;
use DI\ContainerBuilder;
use App\Infrastructure\Persistence\User\UserDoctrineRepository;
return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(UserDoctrineRepository::class),
        ContainerRepository::class =>\DI\autowire(MySqlContainerRepository::class),
        RailRepository::class =>\DI\autowire(MySqlRailRepository::class)
    ]);
};
