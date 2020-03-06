<?php
declare(strict_types=1);

namespace App\Domain\Rail;

use App\Domain\Container\Container;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use App\Domain\User\User;

class Rail implements JsonSerializable
{
    private $id;
    private $name;
    private $location;
    private $containers;
    private $owner;

    public function __construct(?int $id,string $name,string $location)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->containers = new ArrayCollection();
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner(User $owner): void
    {
        $owner->addRail($this);
        $this->owner = $owner;
    }


    public function jsonSerialize()
    {
        return [
            "id"=>$this->id,
            "location" =>$this->location,
            "name" => $this->name,
            "containers" => $this->getContainers()->getValues(),
        ];
    }

    /**
     * @return mixed
     */
    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * @param mixed $containers
     */
    public function addContainers(Container $containers): void
    {
        $this->containers[] = $containers;
    }

}