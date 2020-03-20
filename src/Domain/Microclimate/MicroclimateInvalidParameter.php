<?php


namespace App\Domain\Microclimate;


use App\Domain\DomainException\DomainException;

class MicroclimateInvalidParameter extends DomainException
{
    public $message = "Invalid parameter";

}