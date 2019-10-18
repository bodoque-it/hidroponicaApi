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
            $sql = "SELECT * FROM containers WHERE fk_user=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id]);
            return $stmt->fetchAll();
        }catch (\PDOException $e){
            return array();
        }
    }

    public function findById(int $id): Container
    {
        // TODO: Implement findById() method.
    }

    public function createContainer(int $id,array $params)
    {
        $sql = "INSERT INTO containers VALUES(0,?,?,?,?,?)";
        $stm = $this->db->prepare($sql);
        $stm->execute([$id,$params["id_rail"],$params["volume"],$params["active"],$params["name"]]);
        //$stm->rowCount();

    }

    public function deleteContainer(int $id): bool
    {
        // TODO: Implement deleteContainer() method.
    }

    public function updateContainer(int $id, array $params): Container
    {
        // TODO: Implement updateContainer() method.
    }

    public function getParams()
    {
        $sql = "SHOW columns FROM containers";
        $res = array();
        foreach ($this->db->query($sql) as $row) {
            array_push($res, $row["Field"]);
        }
        unset($res[0]);
        return $res;
    }

    public function getUpdateParams()
    {
        // TODO: Implement getUpdateParams() method.
    }
}