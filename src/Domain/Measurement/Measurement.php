<?php

namespace App\Domain\Measurement;

use App\Domain\Cycle\Cycle;
use JsonSerializable;
use DateTime;

class Measurement implements JsonSerializable{

    private $id;
    private $cycle;
    private $temperature;
    private $humidity;
    private $date;

    /**
     * Measurement constructor.
     * @param $id
     * @param $cycle
     * @param $temperature
     * @param $humidity
     * @param $date
     */
    public function __construct(?int $id,float $temperature,float $humidity,DateTime $date)
    {
        $this->id = $id;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->date = $date;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCycle(): Cycle
    {
        return $this->cycle;
    }

    /**
     * @param mixed $cycle
     */
    public function setCycle(Cycle $cycle): void
    {
        $cycle->addMeasurement($this);
        $this->cycle = $cycle;
    }

    /**
     * @return mixed
     */
    public function getTemperature():float
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return mixed
     */
    public function getHumidity():float
    {
        return $this->humidity;
    }

    /**
     * @param mixed $humidity
     */
    public function setHumidity(float $humidity): void
    {
        $this->humidity = $humidity;
    }

    /**
     * @return mixed
     */
    public function getDate():DateTime
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}