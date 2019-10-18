<?php

namespace App\Infrastructure\Persistence\Rail;

use App\Domain\Container\ContainerRepository;
use \App\Domain\Rail\RailRepository;
use Psr\Container\ContainerInterface;
use \App\Domain\Rail\Rail;
class MySqlRailRepository implements RailRepository
{

    private $db;
    public function __construct(ContainerInterface $container)
    {
        $this->db = $container->get("db");
    }

    public function getAllContainer($id): array
    {
        $sql = "SELECT * from containers WHERE fk_rail=:id";
        $dht = $this->db->prepare($sql);
        $dht->bindParam(':id',$id);
        $dht->execute();
        $res = $dht->fetchAll();
        return $res;
    }
    public function getAllRails($id): array{
        $sql = "select * FROM rails WHERE fk_user=:id";
        $dhp = $this->db->prepare($sql);
        $dhp->bindParam(':id',$id);
        $dhp->execute();
        $out = $dhp->fetchAll();
        $res = array();
        foreach ($out as $rail){
            $r = new Rail($rail["id_rail"],$id,$rail["name"],$rail["location"]);
            array_push($res,$r);
        }
        return $res;

    }

    public function getColumns(): array
    {
        $sql = "SHOW columns FROM rails";
        $res = array();
        foreach ($this->db->query($sql) as $row) {
            array_push($res, $row["Field"]);
        }
        unset($res[0]);
        return $res;
    }

    public function createRail(?string $id, array $params)
    {
        $sql = "INSERT INTO rails VALUES(0,:fk_user,:name,:location)";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':fk_user',$id);
        $stm->bindParam(':name',$params["name"]);
        $stm->bindParam(':location',$params["location"]);
        $stm->execute();
    }

    public function getRailById(?string $id_user, ?string $id_rail): Rail
    {
        $sql = "SELECT * FROM rails WHERE fk_user=:id_user AND id_rail=:id_rail";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':id_user',$id_user);
        $stm->bindParam('id_rail',$id_rail);
        $stm->execute();
        $rail = $stm->fetch();
        return new Rail($rail["id_rail"],$rail["fk_user"],$rail["name"],$rail["location"]);
    }

    public function updateRail(?string $id_user, ?string $id_rail, array $params)
    {
        $sql = "UPDATE rails SET name=?,location=? WHERE fk_user=? and  id_rail=?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$params["name"],$params["location"],$id_user,$id_rail]);
    }

    public function deleteRail(?string $id_user, ?string $id_rail)
    {
        $sql = "DELETE FROM rails WHERE fk_user=? AND id_rail=?";
        $stm = $this->db->prepare($sql);
        $stm->execute([$id_user,$id_rail]);
        return $stm->rowCount();
    }

    public function getRailParams()
    {
        $sql = "SHOW columns FROM rails";
        $res = array();
        foreach ($this->db->query($sql) as $row) {
            array_push($res, $row["Field"]);
        }
        unset($res[0]);
        unset($res[1]);
        error_log(print_r($res, true));
        return $res;
    }
}