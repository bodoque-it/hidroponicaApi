<?php
declare(strict_types=1);

namespace App\Domain\Container;


use PhpOption\Tests\Repository;
use App\Domain\Container\Container;

interface ContainerRepository{
    public function findAll(int $user_id):array ;
    public function findById(int $id_user,int $id):Container;
    public function createContainer(int $id,array $params):Container;
    public function deleteContainer(int $id):bool ;
    public function updateContainer(int $id,array $params):Container;
    public function getParams():array ;
    public function getUpdateParams():array ;
    public function createContainerInRail(int $id_user,int $id_rail,array $params):Container;
}