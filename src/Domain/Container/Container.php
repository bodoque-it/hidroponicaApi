<?php

namespace App\Domain\Container;
use JsonSerializable;

class Container implements \JsonSerializable
{
    private $id;
    private $volume;
    private $active;
    private $name;

    public function __construct(int $id,float $volume,string $name, bool $active=false)
    {
        $this->id = $id;
        $this->volume = $volume;
        $this->active = $active;
        $this->name = $name;
    }

    public function isActivate(){
        return $this->active;
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
        ];
    }
}