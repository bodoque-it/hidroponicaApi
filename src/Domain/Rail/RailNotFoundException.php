<?php


namespace App\Domain\Rail;


use App\Domain\DomainException\DomainRecordNotFoundException;

class RailNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The rail you requested does not exist.';
}