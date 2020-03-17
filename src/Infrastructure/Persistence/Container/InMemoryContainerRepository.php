<?php


namespace App\Infrastructure\Persistence\Container;


use App\Domain\Container\Container;
use App\Domain\Container\ContainerRepository;

class InMemoryContainerRepository implements ContainerRepository
{

    private $containers;
    /**
     * InMemoryContainerRepository constructor.
     */
    public function __construct()
    {
        $this->containers = [
                1 => new Container(1,10.0,"primer")
            ];
    }

    public function findAll(int $user_id): array
    {
        // TODO: Implement findAll() method.
    }

    public function findById(int $id_user, int $id): Container
    {
        // TODO: Implement findById() method.
    }

    public function createContainer(int $id, array $params): Container
    {
        $this->containers[2] = new Container(2,$params["volume"],$params);
    }

    public function deleteContainer(int $id): bool
    {
        // TODO: Implement deleteContainer() method.
    }

    public function updateContainer(int $id, array $params): Container
    {
        // TODO: Implement updateContainer() method.
    }

    public function getParams(): array
    {
        // TODO: Implement getParams() method.
    }

    public function getUpdateParams(): array
    {
        // TODO: Implement getUpdateParams() method.
    }

    public function createContainerInRail(int $id_user, int $id_rail, array $params): Container
    {
        // TODO: Implement createContainerInRail() method.
    }
}