<?php


namespace App\Domain\Infrastructure;


use App\Domain\DomainException\DomainRecordNotFoundException;

class InfrastructureNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The infrastructure you requested does not exist.';
}