<?php
declare(strict_types=1);

namespace App\Domain\Container;


use PhpOption\Tests\Repository;
use App\Domain\Container\Container;

interface ContainerRepository{
    public function findAll(int $user_id):array ;
    public function findById(int $id):Container;
    public function createContainer(float $volumen, bool $isActive,string $name):Container;
    public function deleteContainer(int $id):bool;
    public function updateContainer(int $id,array $params):Container;
}