<?php


namespace App\Domain\Measurement;


interface MeasurementRepository
{

    public function findAll(int $id_cycle):array ;
    public function findById(int $id_measurement):Measurement;
    public function createMeasurement(int $id_cycle,array $params):Measurement;
    public function deleteMeasurement(int $id_measurement):bool ;
    public function getParams():array;
}