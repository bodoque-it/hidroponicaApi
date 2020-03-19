<?php


namespace App\Domain\Infrastructure;


interface InfrastructureRepository
{

    public function findAll(int $id_user):array;
    public function findById(int $id_infrastructure):Infrastructure;
    public function deleteInfrastructure(int $id_infrastructure):bool ;
    public function updateInfrastructure(int $in_infrastructure,array $params):Infrastructure;
    public function createInfrastructure(int $id_user,array $params):Infrastructure;
}