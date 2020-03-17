<?php


namespace App\Domain\Cycle;


use App\Domain\DomainException\DomainRecordNotFoundException;

class CycleNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The cycle you requested does not exist.';
}