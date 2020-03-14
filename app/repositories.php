<?php
declare(strict_types=1);

use App\Domain\Container\ContainerRepository;
use App\Domain\Rail\RailRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Container\DoctrineContainerRepository;
use App\Infrastructure\Persistence\Rail\DoctrineRailRepository;
use DI\ContainerBuilder;
use App\Infrastructure\Persistence\User\UserDoctrineRepository;
return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(UserDoctrineRepository::class),
        ContainerRepository::class =>\DI\autowire(DoctrineContainerRepository::class),
        RailRepository::class =>\DI\autowire(DoctrineRailRepository::class)
    ]);
};
