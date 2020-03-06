<?php

class Microclimate implements JsonSerializable{

    private $id;
    private $owner;
    private $name;
    private $intensity;
    private $lightType;
    private $waterPH;
    private $dailyHours;
    private $lightStartTime;

    /**
     * Microclimate constructor.
     * @param $id
     * @param $owner
     * @param $name
     * @param $intensity
     * @param $lightType
     * @param $waterPH
     * @param $dailyHours
     * @param $lightStartTime
     */
    public function __construct($id, $name, $intensity, $lightType, $waterPH, $dailyHours, $lightStartTime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->intensity = $intensity;
        $this->lightType = $lightType;
        $this->waterPH = $waterPH;
        $this->dailyHours = $dailyHours;
        $this->lightStartTime = $lightStartTime;
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
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIntensity()
    {
        return $this->intensity;
    }

    /**
     * @param mixed $intensity
     */
    public function setIntensity($intensity): void
    {
        $this->intensity = $intensity;
    }

    /**
     * @return mixed
     */
    public function getLightType()
    {
        return $this->lightType;
    }

    /**
     * @param mixed $lightType
     */
    public function setLightType($lightType): void
    {
        $this->lightType = $lightType;
    }

    /**
     * @return mixed
     */
    public function getWaterPH()
    {
        return $this->waterPH;
    }

    /**
     * @param mixed $waterPH
     */
    public function setWaterPH($waterPH): void
    {
        $this->waterPH = $waterPH;
    }

    /**
     * @return mixed
     */
    public function getDailyHours()
    {
        return $this->dailyHours;
    }

    /**
     * @param mixed $dailyHours
     */
    public function setDailyHours($dailyHours): void
    {
        $this->dailyHours = $dailyHours;
    }

    /**
     * @return mixed
     */
    public function getLightStartTime()
    {
        return $this->lightStartTime;
    }

    /**
     * @param mixed $lightStartTime
     */
    public function setLightStartTime($lightStartTime): void
    {
        $this->lightStartTime = $lightStartTime;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}