<?php

namespace App\Domain\Cycle;

use App\Domain\Container\Container;
use App\Domain\Measurement\Measurement;
use App\Domain\Microclimate\Microclimate;
use App\Domain\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use DateTime;

class Cycle implements JsonSerializable {

    private $id;
    private $startDate;
    private $estimatedDate;
    private $finishDate;
    private $owner;
    private $container;
    private $microclimate;
    private $measurements;

    /**
     * Cycle constructor.
     * @param int|null $id
     * @param $start_date
     * @param $estimated_date
     * @param $finish_date
     */
    public function __construct(?int $id,DateTime $start_date,DateTime $estimated_date)
    {
        $this->id = $id;
        $this->startDate = $start_date;
        $this->estimatedDate = $estimated_date;
        $this->measurements = new ArrayCollection();
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
     * @return mixed
     */
    public function getStartDate():DateTime
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEstimatedDate():DateTime
    {
        return $this->estimatedDate;
    }

    /**
     * @param mixed $estimatedDate
     */
    public function setEstimatedDate(DateTime $estimatedDate): void
    {
        $this->estimatedDate = $estimatedDate;
    }

    /**
     * @return mixed
     */
    public function getFinishDate():DateTime
    {
        return $this->finishDate;
    }

    /**
     * @param mixed $finishDate
     */
    public function setFinishDate(DateTime $finishDate): void
    {
        $this->finishDate = $finishDate;
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
        $owner->addCycle($this);
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getContainer():Container
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     */
    public function setContainer(Container $container): void
    {
        $container->addCycles($this);
        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function getMicroclimate():Microclimate
    {
        return $this->microclimate;
    }

    /**
     * @param mixed $microclimate
     */
    public function setMicroclimate(Microclimate $microclimate): void
    {
        $microclimate->addCycles($this);
        $this->microclimate = $microclimate;
    }

    /**
     * @return mixed
     */
    public function getMeasurements()
    {
        return $this->measurements;
    }

    /**
     * @param Measurement $measurement
     */
    public function addMeasurement(Measurement $measurement): void
    {
        $this->measurements[] = $measurement;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'estimated_date' => $this->getEstimatedDate(),
            'finish_date' => $this->getFinishDate(),
            'start_date' => $this->getStartDate(),
        ];
    }
}