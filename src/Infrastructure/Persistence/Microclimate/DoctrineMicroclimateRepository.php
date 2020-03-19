<?php


namespace App\Infrastructure\Persistence\Microclimate;


use App\Domain\Microclimate\Microclimate;
use App\Domain\Microclimate\MicroclimateNotFoundException;
use App\Domain\Microclimate\MicroclimateRepository;
use App\Domain\User\UserNotFoundException;
use Psr\Container\ContainerInterface;

class DoctrineMicroclimateRepository implements MicroclimateRepository
{


    /**
     * DoctrineMicroclimateRepository constructor.
     */
    private $entityManager;
    public function __construct(ContainerInterface $container)
    {
        $this->entityManager = $container->get("doctrine");
    }

    public function findAll(int $id_user): array
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user===null){
            throw new UserNotFoundException();
        }
        return $user->getMicroclimates()->getValues();
    }

    public function findById(int $id_microclimate): Microclimate
    {
        $microclimate = $this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
        if($microclimate===null){
            throw new MicroclimateNotFoundException();
        }
        return $microclimate;
    }

    public function createMicroclimate(int $id_user, array $params): Microclimate
    {
        $user = $this->entityManager->find("App\Domain\User\User",$id_user);
        if($user===null){
            throw new UserNotFoundException();
        }
        $lightStartTime = new \DateTime($params["lightStartTime"]);
        $microclimate = new Microclimate(null,
            $params["name"],
            $params["intensity"],
            $params["lightType"],
            $params["waterPH"],
            $params["dailyHours"],
            $lightStartTime,
            $params["temperature"],
            $params["humidity"]
        );
        $microclimate->setOwner($user);
        $this->entityManager->persist($microclimate);
        $this->entityManager->flush();
        return $microclimate;
    }

    public function deleteMicroclimate(int $id_microclimate): bool
    {
        $microclimate = $this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
        if($microclimate===null){
            throw new MicroclimateNotFoundException();
        }
        $this->entityManager->remove($microclimate);
        $this->entityManager->flush();
        return true;
    }

    public function getParams(): array
    {
        return [
            'name',
            'intensity',
            'waterPH',
            'dailyHours',
            'lightStartTime'
        ];
    }

    public function updateMicroclimate(int $id_microclimate,array $params): Microclimate
    {
        $microclimate =$this->entityManager->find("App\Domain\Microclimate\Microclimate",$id_microclimate);
        if($microclimate===null){
            throw new MicroclimateNotFoundException();
        }
        if(isset($params["name"])){
            $microclimate->setName($params["name"]);
        }
        if(isset($params["intensity"])){
            $microclimate->setIntensity($params["intensity"]);
        }
        if(isset($params["lightType"])){
            $microclimate->setLightType($params["lightType"]);
        }
        if(isset($params["waterPH"])){
            $microclimate->setWaterPH($params["waterPH"]);
        }
        if(isset($params["dailyHours"])){
            $microclimate->setDailyHours($params["dailyHours"]);
        }
        if(isset($params["humidity"])){
            $microclimate->setHumidity($params["humidity"]);
        }
        if(isset($params["temperature"])){
            $microclimate->setTemperature($params["temperature"]);
        }
        if(isset($params["lightStartTime"])){
            $lightStartTime = new \DateTime($params["lightStartTime"]);
            $microclimate->setLightStartTime($lightStartTime);
        }
        $this->entityManager->flush();
        return $microclimate;
    }
}