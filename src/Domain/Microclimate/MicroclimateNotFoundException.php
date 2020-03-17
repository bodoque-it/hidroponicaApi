<?php


namespace App\Domain\Microclimate;


use App\Domain\DomainException\DomainRecordNotFoundException;

class MicroclimateNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The microclimate you requested does not exist.';
}