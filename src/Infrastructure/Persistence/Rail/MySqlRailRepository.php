<?php

namespace App\Infrastructure\Persistence\Rail;

use App\Domain\Container\ContainerRepository;
use \App\Domain\Rail\RailRepository;
use Psr\Container\ContainerInterface;

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
            array_push($res,$rail["id_rail"]);
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
}