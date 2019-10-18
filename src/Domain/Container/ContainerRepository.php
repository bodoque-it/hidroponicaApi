<?php
declare(strict_types=1);

namespace App\Domain\Container;


use PhpOption\Tests\Repository;
use App\Domain\Container\Container;

interface ContainerRepository{
    public function findAll(int $user_id):array ;
    public function findById(int $id_user,int $id);
    public function createContainer(int $id,array $params);
    public function deleteContainer(int $id);
    public function updateContainer(int $id,array $params);
    public function getParams();
    public function getUpdateParams();
}