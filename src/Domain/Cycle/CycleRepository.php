<?php


namespace App\Domain\Cycle;


interface CycleRepository
{
    public function findAll(int $user_id):array ;
    public function findById(int $id_cycle):Cycle;
    public function createCycle(int $id,array $params):Cycle;
    public function deleteCycle(int $id):bool ;
    public function updateCycle(int $id,array $params):Cycle;
    public function getParams():array ;
    public function createCycleContainerMicroclimate(int $id_user, int $id_container, int $id_microclimate, array $params): Cycle;
}