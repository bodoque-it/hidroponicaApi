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

    }
    public function getAllRails($id): array{
        $sql = "select * FROM rails WHERE fk_user=:id";
        $dhp = $this->db->prepare($sql);
        $dhp->bindParam(':id',$id);
        $dhp->execute();
        $res = $dhp->fetchAll();

        return $res["id_rail"];

    }
}