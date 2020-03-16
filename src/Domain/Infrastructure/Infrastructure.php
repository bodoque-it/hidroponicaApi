<?php


namespace App\Domain\Infrastructure;


use App\Domain\User\User;
use Doctrine\Common\Collections\ArrayCollection;

class Infrastructure implements \JsonSerializable
{
    private $address;
    private $owner;
    private $rails;

    /**
     * Infrastructure constructor.
     * @param $address
     */
    public function __construct($address)
    {
        $this->address = $address;
        $this->rails = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getOwner():User
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner(User $owner): void
    {
        $owner->addInfrastructures($this);
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getRails()
    {
        return $this->rails;
    }

    /**
     * @param mixed $rails
     */
    public function setRails($rails): void
    {
        $this->rails = $rails;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}