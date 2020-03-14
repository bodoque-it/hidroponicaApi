<?php


namespace App\Domain\Microclimate;


interface MicroclimateRepository
{
    public function findAll(int $id_user):array ;
    public function findById(int $id_microclimate):Microclimate;
    public function createMicroclimate(int $id_user,array $params):Microclimate;
    public function deleteMicroclimate(int $id_measurement):bool ;
    public function getParams():array;

}