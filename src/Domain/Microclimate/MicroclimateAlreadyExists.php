<?php


namespace App\Domain\Microclimate;


use App\Domain\DomainException\DomainRecordAlreadyExists;

class MicroclimateAlreadyExists extends DomainRecordAlreadyExists
{
    public $message = "The microclimate with this name already exists";
}