<?php

namespace App\Domain\Container;
use App\Domain\Cycle\Cycle;
use App\Domain\Rail\Rail;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use App\Domain\User\User;

class Container implements \JsonSerializable
{
    private $id;
    private $volume;
    private $active;
    private $name;
    private $owner;
    private $rail;
    private $cycles;

    public function __construct(?int $id,float $volume,string $name, bool $active=false)
    {
        $this->id = $id;
        $this->volume = $volume;
        $this->active = $active;
        $this->name = $name;
        $this->cycles = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getCycles(): array
    {
        return $this->cycles;
    }

    /**
     * @param Cycle $cycle
     */
    public function addCycles(Cycle $cycle): void
    {
        $this->cycles[] = $cycle;
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
        $owner->addContainer($this);
        $this->owner = $owner;
    }


    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume(float $volume): void
    {
        $this->volume = $volume;
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

    public function isActivate(){
        return $this->active;
    }
    public function setActive(bool $active){
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getRail()
    {
        return $this->rail;
    }

    /**
     * @param mixed $rail
     */
    public function setRail(Rail $rail): void
    {
        $rail->addContainers($this);
        $this->rail = $rail;
    }



    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'active' => $this->active,
            'volume' => $this->volume
        ];
    }
}