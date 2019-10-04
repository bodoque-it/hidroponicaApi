<?php


namespace App\Infrastructure\Persistence\Container;


use App\Domain\Container\Container;
use App\Domain\Container\ContainerRepository;
use Psr\Container\ContainerInterface;
use function DI\get;

class MySqlContainerRepository implements ContainerRepository
{
    private $db;
    public function __construct(ContainerInterface $container)
    {
        $this->db = $container->get("db");
    }

    public function findAll(int $user_id): array
    {
        try{
            $sql = "SELECT * FROM containers";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        }catch (\PDOException $e){
            return array();
        }
    }

    public function findById(int $id): Container
    {
        // TODO: Implement findById() method.
    }

    public function createContainer(float $volumen, bool $isActive, string $name): Container
    {
        // TODO: Implement createContainer() method.
    }

    public function deleteContainer(int $id): bool
    {
        // TODO: Implement deleteContainer() method.
    }

    public function updateContainer(int $id, array $params): Container
    {
        // TODO: Implement updateContainer() method.
    }
}