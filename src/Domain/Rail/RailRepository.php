<?php


namespace App\Domain\Rail;


use phpDocumentor\Reflection\Types\Void_;

interface RailRepository
{
    public function getAllContainer($id):array;
    public function getAllRails($id): array;

    public function getColumns():array ;

    public function createRail(?string $id, array $params);

    public function getRailById(?string $id_user, ?string $id_rail):Rail;

}