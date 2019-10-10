<?php


namespace App\Domain\Rail;


interface RailRepository
{
    public function getAllContainer($id):array;
    public function getAllRails($id): array;

    public function getColumns():array ;

}