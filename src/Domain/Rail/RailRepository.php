<?php


namespace App\Domain\Rail;


use phpDocumentor\Reflection\Types\Void_;

interface RailRepository
{
    public function getAllContainer($id):array;
    public function getAllRails($id): array;

    public function getColumns():array ;

    public function createRail(?string $id, array $params):Rail;

    public function getRailById(?string $id_user, ?string $id_rail):Rail;

    public function updateRail(?string $id_user, ?string $id_rail, array $params):Rail;

    public function deleteRail(?string $id_user, ?string $id_rail):bool;

    public function getRailParams():array ;

}