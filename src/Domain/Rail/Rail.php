<?php
declare(strict_types=1);

namespace App\Domain\Rail;

use App\Domain\Container\Container;
use App\Domain\Infrastructure\Infrastructure;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use App\Domain\User\User;

class Rail implements JsonSerializable
{
    private $id;
    private $name;
    private $containers;
    private $owner;
    private $infrastructure;

    public function __construct(?int $id,string $name)
    {
        $this->id = $id;
        $this->name = $name;
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
            "name" => $this->name,
            "containers" => $this->getContainers()->getValues(),
            "infrastructure"=>$this->getInfrastructure()
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

    /**
     * @return mixed
     */
    public function getInfrastructure()
    {
        return $this->infrastructure;
    }

    /**
     * @param mixed $infrastructure
     */
    public function setInfrastructure(Infrastructure $infrastructure): void
    {
        $infrastructure->addRails($this);
        $this->infrastructure = $infrastructure;
    }


}