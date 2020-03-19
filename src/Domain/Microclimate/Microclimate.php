<?php

namespace App\Domain\Microclimate;

use App\Domain\Cycle\Cycle;
use App\Domain\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use DateTime;

class Microclimate implements JsonSerializable{

    private $id;
    private $owner;
    private $name;
    private $intensity;
    private $lightType;
    private $waterPH;
    private $dailyHours;
    private $lightStartTime;
    private $cycles;

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
    public function __construct(?int $id,string $name,float $intensity,string $lightType,float $waterPH,int $dailyHours,DateTime $lightStartTime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->intensity = $intensity;
        $this->lightType = $lightType;
        $this->waterPH = $waterPH;
        $this->dailyHours = $dailyHours;
        $this->lightStartTime = $lightStartTime;
        $this->cycles = new ArrayCollection();
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
    public function getOwner():User
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner(User $owner): void
    {
        $owner->addMicroclimates($this);
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIntensity():float
    {
        return $this->intensity;
    }

    /**
     * @param mixed $intensity
     */
    public function setIntensity(float $intensity): void
    {
        $this->intensity = $intensity;
    }

    /**
     * @return mixed
     */
    public function getLightType():string
    {
        return $this->lightType;
    }

    /**
     * @param mixed $lightType
     */
    public function setLightType(string $lightType): void
    {
        $this->lightType = $lightType;
    }

    /**
     * @return mixed
     */
    public function getWaterPH():float
    {
        return $this->waterPH;
    }

    /**
     * @param mixed $waterPH
     */
    public function setWaterPH(float $waterPH): void
    {
        $this->waterPH = $waterPH;
    }

    /**
     * @return mixed
     */
    public function getDailyHours():int
    {
        return $this->dailyHours;
    }

    /**
     * @param mixed $dailyHours
     */
    public function setDailyHours(int $dailyHours): void
    {
        $this->dailyHours = $dailyHours;
    }

    /**
     * @return mixed
     */
    public function getLightStartTime(): DateTime
    {
        return $this->lightStartTime;
    }

    /**
     * @param mixed $lightStartTime
     */
    public function setLightStartTime(DateTime $lightStartTime): void
    {
        $this->lightStartTime = $lightStartTime;
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
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id'=>$this->getId(),
            'name' =>$this->getName(),
            'dailyHours' =>$this->getDailyHours(),
            'intensity' =>$this->getIntensity(),
            'lightType' =>$this->getLightType(),
            'lightStartTime' =>$this->getLightStartTime(),
            'waterPH' => $this->getWaterPH()
        ];
    }
}