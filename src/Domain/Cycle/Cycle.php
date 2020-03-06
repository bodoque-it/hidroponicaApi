<?php

class Cycle implements JsonSerializable {
    private $startDate;
    private $estimatedDate;
    private $finishDate;
    private $user;
    private $container;
    private $microclimate;
    /**
     * Cycle constructor.
     * @param $start_date
     * @param $estimated_date
     * @param $finish_date
     * @param $user
     * @param $container
     * @param $microclimate
     */
    public function __construct($start_date, $estimated_date, $finish_date)
    {
        $this->startDate = $start_date;
        $this->estimatedDate = $estimated_date;
        $this->finishDate = $finish_date;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEstimatedDate()
    {
        return $this->estimatedDate;
    }

    /**
     * @param mixed $estimatedDate
     */
    public function setEstimatedDate($estimatedDate): void
    {
        $this->estimatedDate = $estimatedDate;
    }

    /**
     * @return mixed
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * @param mixed $finishDate
     */
    public function setFinishDate($finishDate): void
    {
        $this->finishDate = $finishDate;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     */
    public function setContainer($container): void
    {
        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function getMicroclimate()
    {
        return $this->microclimate;
    }

    /**
     * @param mixed $microclimate
     */
    public function setMicroclimate($microclimate): void
    {
        $this->microclimate = $microclimate;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}