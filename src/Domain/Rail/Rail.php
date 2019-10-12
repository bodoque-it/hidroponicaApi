<?php
declare(strict_types=1);

namespace App\Domain\Rail;

use JsonSerializable;
class Rail implements JsonSerializable
{
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private $fk_user;
    private $name;
    private $location;

    public function __construct(int $id,int $fk_user,string $name,string $location)
    {
        $this->id = $id;
        $this->fk_user = $fk_user;
        $this->name = $name;
        $this->location = $location;
    }

    public function jsonSerialize()
    {
        return [
            "id"=>$this->id,
            "fk_user" =>$this->fk_user,
            "location" =>$this->location,
            "name" => $this->name
        ];
    }
}