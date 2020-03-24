<?php


namespace App\Domain\Container;


use App\Domain\DomainException\DomainRecordAlreadyExists;

class ContainerAlreadyExists extends DomainRecordAlreadyExists
{
    public $message = "The container with this name already exists";
}